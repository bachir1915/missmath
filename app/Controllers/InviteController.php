<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Dompdf\Options;

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
        
        // Configuration par défaut pour un nouvel invité créé par l'admin
        $data['code_unique'] = bin2hex(random_bytes(16));
        $data['role']        = 'invite';
        
        // Si le statut n'est pas spécifié, on met 'en_attente'
        if (!isset($data['statut'])) {
            $data['statut'] = 'en_attente';
        }

        if ($this->model->insert($data)) {
            // Génération du QR Code
            $this->generateQr($data['code_unique']);
            
            // Envoi de l'email d'invitation
            $this->sendInvitationEmail($data['code_unique']);

            return redirect()->to('/admin/invites')->with('success', 'Invité créé avec succès et invitation envoyée.');
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

    /**
     * Logique de génération du QR Code.
     */
    private function generateQr($code)
    {
        $path = FCPATH . 'uploads/qrcodes/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $url = base_url("/scan?code=$code");

        $qrCode = QrCode::create($url)
            ->setSize(400)
            ->setMargin(10);
        
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        
        $fileName = $code . '.png';
        $result->saveToFile($path . $fileName);

        $this->model->where('code_unique', $code)->set(['qr_path' => $fileName])->update();
    }

    /**
     * Envoie l'invitation par email
     */
    private function sendInvitationEmail($code)
    {
        $invite = $this->model->where('code_unique', $code)->first();
        if (!$invite) return;

        $to   = $invite['email'];
        $name = $invite['prenom'] . ' ' . $invite['nom'];
        $link = base_url("/ticket/$code");
        $qrPath  = FCPATH . 'uploads/qrcodes/' . $code . '.png';
        $pdfPath = FCPATH . 'uploads/tickets/ticket_' . $code . '.pdf';

        if (!is_dir(FCPATH . 'uploads/tickets/')) {
            mkdir(FCPATH . 'uploads/tickets/', 0777, true);
        }

        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setSubject('✨ Votre Invitation Officielle - Miss Maths/Miss Sciences 2026');

        $cid = '';
        if (file_exists($qrPath)) {
            $email->attach($qrPath);
            $cid = $email->setAttachmentCID($qrPath);
        }

        if (!file_exists($pdfPath)) {
            try {
                $options = new Options();
                $options->set('isRemoteEnabled', false);
                $options->set('chroot', FCPATH);
                $dompdf = new Dompdf($options);

                $html = view('emails/invitation_pdf', [
                    'name'      => $name,
                    'telephone' => $invite['telephone'],
                    'qrPath'    => $qrPath,
                    'code'      => $code,
                    'invite'    => $invite
                ]);
                $dompdf->loadHtml($html);
                $dompdf->setPaper('A4', 'portrait');
                $dompdf->render();
                file_put_contents($pdfPath, $dompdf->output());
            } catch (\Exception $e) {
                log_message('error', 'Erreur PDF : ' . $e->getMessage());
            }
        }

        if (file_exists($pdfPath)) {
            $email->attach($pdfPath, 'application/pdf', 'Invitation_MissMaths_2026.pdf');
        }

        $message = view('emails/invitation', [
            'name' => $name,
            'link' => $link,
            'cid'  => $cid
        ]);
        $email->setMessage($message);

        if (!$email->send()) {
            log_message('error', 'Erreur Email : ' . $email->printDebugger(['headers']));
        }
    }
}
