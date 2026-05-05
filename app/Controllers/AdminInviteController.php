<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class AdminInviteController extends ResourceController
{
    protected $modelName = UserModel::class;
    protected $format    = 'html';

    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $data['invites'] = $this->model->where('role', 'invite')->findAll();
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
            return redirect()->to('/admin/invites')->with('success', 'Invité créé avec succès.');
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
            return redirect()->to('/admin/invites')->with('success', 'Invité mis à jour.');
        }
        return redirect()->back()->withInput()->with('errors', $this->model->errors());
    }

    /**
     * Valide manuellement une invitation 
     */
    public function confirmEntry($id = null)
    {
        $this->model->update($id, ['statut' => 'utilise', 'updated_at' => date('Y-m-d H:i:s')]);
        return redirect()->to('/admin/invites')->with('success', 'Invitation validée manuellement.');
    }

    /**
     * Annule une invitation
     */
    public function cancel($id = null)
    {
        $this->model->update($id, ['statut' => 'annule']);
        return redirect()->to('/admin/invites')->with('success', 'Invitation annulée.');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $this->model->delete($id);
        return redirect()->to('/admin/invites')->with('success', 'Invité supprimé.');
    }
}
