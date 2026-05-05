<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class VerificationController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
   
    // cette fonction gere la logique de validation des tickets 
    public function checkTicket()
    {
        // recuperation du code 
        $code = $this->request->getVar('code');
        $isAjax = $this->request->isAJAX();

        // 1. Verification de la presence du code
        if (empty($code)) {
            if ($isAjax) return $this->response->setJSON(['status' => 'error', 'message' => 'Code manquant.']);
            return redirect()->to('/admin/scanner')->with('error', 'Aucun code détecté.');
        }

        // 2. Recherche de l invite
        $invite = $this->userModel->where('code_unique', $code)->where('role', 'invite')->first();

        // 3. Si invalide
        if (!$invite) {
            $data = ['status' => 'error', 'message' => 'Invitation invalide (Code inconnu).', 'invite' => null];
            if ($isAjax) return $this->response->setJSON($data);
            return view('admin/verify_result', $data);
        }

        // 4. Si deja utilise
        if ($invite['statut'] === 'valide') {
            $msg = 'ALERTE : Ce ticket a déjà été validé le ' . date('d/m/Y à H:i', strtotime($invite['updated_at']));
            $data = ['status' => 'fraud', 'message' => $msg, 'invite' => $invite];
            if ($isAjax) return $this->response->setJSON($data);
            return view('admin/verify_result', $data);
        }

        // 5. Si annule
        if ($invite['statut'] === 'annule') {
            $data = ['status' => 'error', 'message' => 'Cette invitation a été annulée.', 'invite' => $invite];
            if ($isAjax) return $this->response->setJSON($data);
            return view('admin/verify_result', $data);
        }

        /**
         * 6. LOGIQUE DE VALIDATION (RESERVEE AUX ADMINS)
         * Si c est un admin qui scanne, on valide l entree.
         * Si c est un anonyme, on affiche juste les infos sans valider.
         */
        $isAdmin = (session()->get('role') === 'admin');
        
        if ($isAdmin) {
            $this->userModel->update($invite['id'], [
                'statut' => 'valide',
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $invite['statut'] = 'valide'; 
            $message = 'Accès AUTORISÉ. Bienvenue ' . $invite['prenom'] . ' ' . $invite['nom'];
        } else {
            $message = 'Ticket VALIDE pour ' . $invite['prenom'] . ' ' . $invite['nom'] . '. (Validation admin requise)';
        }
        
        $data = [
            'status'  => 'success',
            'message' => $message,
            'invite'  => $invite,
            'isAdmin' => $isAdmin
        ];
        // on ajoute le code unique 

        if ($isAjax) return $this->response->setJSON($data);
        return view('admin/verify_result', $data);
    }
}
