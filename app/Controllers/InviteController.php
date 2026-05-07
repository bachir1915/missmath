<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class InviteController extends ResourceController
{
    protected $modelName = UserModel::class;
    protected $format    = 'html';
    protected $helpers   = ['phone'];

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        //filtrage des invitations par statut et categorie
        $status = $this->request->getGet('status') ?? 'en_attente';
        $category = $this->request->getGet('category'); // e.g., 1, 2, 3, 4
        
        //requete pour filtrer les invitations
        $query = $this->model->select('utilisateurs.*, categories.nom as category_name')
                             ->join('categories', 'categories.id = utilisateurs.category_id', 'left')
                             ->where('utilisateurs.role', 'invite');
        
        if ($status !== 'tous') {
            $query->where('utilisateurs.statut', $status);
        }
        if ($category) {
            $query->where('utilisateurs.category_id', $category);
        }
        
        $data['invites'] = $query->orderBy('utilisateurs.id', 'DESC')->findAll();
        $data['current_status'] = $status;
        $data['current_category'] = $category;
        
        // Comptages pour les onglets
        $data['count_all'] = $this->model->where('role', 'invite')->countAllResults();
        $data['count_pending'] = $this->model->where('role', 'invite')->where('statut', 'en_attente')->countAllResults();
        $data['count_validated'] = $this->model->where('role', 'invite')->whereIn('statut', ['valide', 'scanne'])->countAllResults();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'html' => view('admin/invites/partials/table_body', ['invites' => $data['invites']]),
                'counts' => [
                    'all' => $data['count_all'],
                    'pending' => $data['count_pending'],
                    'validated' => $data['count_validated']
                ]
            ]);
        }

        return view('admin/invites/index', $data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $data['invite'] = $this->model->find($id);
        if (!$data['invite']) return redirect()->to('/admin/invites')->with('error', 'Invité non trouvé.');
        return view('admin/invites/show', $data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        return view('admin/invites/new');
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $data = $this->request->getPost();
        if ($this->model->insert($data)) {
            return redirect()->to('/admin/invites')->with('success', 'Invite cree avec succes.');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $data['invite'] = $this->model->find($id);
        if (!$data['invite']) return redirect()->to('/admin/invites')->with('error', 'Invité non trouvé.');
        return view('admin/invites/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        $data = $this->request->getPost();
        if ($this->model->update($id, $data)) {
            return redirect()->to('/admin/invites')->with('success', 'Invite mis a jour.');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    /**
     * Valide manuellement une invitation (marque comme Utilise)
     */
    public function confirmEntry($id = null)
    {
        $this->model->update($id, ['statut' => 'valide', 'updated_at' => date('Y-m-d H:i:s')]);
        
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success', 
                'message' => 'Invitation validée avec succès.',
                'date' => date('d/m H:i')
            ]);
        }
        
        return redirect()->to('/admin/invites')->with('success', 'Invitation validee');
    }

    /**
     * Annule une invitation
     */
    public function cancel($id = null)
    {
        $this->model->update($id, ['statut' => 'annule']);
        return redirect()->to('/admin/invites')->with('success', 'Invitation annulee.');
    }

    /**
     * Valide toutes les invitations en attente d'un coup
     */
    public function validateAll()
    {
        $this->model->where('role', 'invite')
                    ->where('statut', 'en_attente')
                    ->set(['statut' => 'valide', 'updated_at' => date('Y-m-d H:i:s')])
                    ->update();

        return redirect()->to('/admin/invites');
    }

    /**
     * Exporte la liste des invites au format Excel (Styled HTML)
     */
    public function exportCSV() // Gardons le meme nom de methode pour ne pas casser la route, mais on change le contenu
    {
        $status = $this->request->getGet('status') ?? 'tous';
        
        $query = $this->model->select('utilisateurs.*, categories.nom as category_name')
                             ->join('categories', 'categories.id = utilisateurs.category_id', 'left')
                             ->where('utilisateurs.role', 'invite');
                             
        if ($status !== 'tous') {
            $query->where('utilisateurs.statut', $status);
        }
        
        $invites = $query->orderBy('utilisateurs.category_id', 'ASC')->orderBy('utilisateurs.id', 'DESC')->findAll();

        $filename = 'Invites_MissMath_2026_' . date('Ymd_His') . '.xls';
        $html = view('admin/invites/export_excel', ['invites' => $invites]);
        
        return $this->response->download($filename, $html)->setContentType('application/vnd.ms-excel');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/invites')->with('success', 'Invite supprime.');
    }
}
