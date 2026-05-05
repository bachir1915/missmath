<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Config\Services;
use App\Models\UserModel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Dompdf\Dompdf;
use Dompdf\Options;

class InscriptionController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
   
    // page d accueil pour les invites
    public function index()
    {
        return view('public/register');
    }

   // Traitement du formulaire d inscription 
    public function submit()
    {
        $email = trim(strtolower($this->request->getPost('email')));
        $telephone = trim($this->request->getPost('telephone'));

        // On ne vérifie plus manuellement pour laisser le UserModel gérer l'unicité
        // et renvoyer une erreur explicite si l'email ou le téléphone existe déjà.

        // Sinon, on procède à une nouvelle inscription
        $data = [
            'prenom'         => trim($this->request->getPost('prenom')),
            'nom'            => trim($this->request->getPost('nom')),
            'email'          => $email,
            'telephone'      => $telephone,
            'category_id'    => $this->mapCategoryToId($this->request->getPost('type')),
            'establishment'  => ($this->request->getPost('establishment') === 'Autre') ? trim($this->request->getPost('establishment_other')) : $this->request->getPost('establishment'),
            'class'          => $this->request->getPost('class'),
            'profession'     => $this->request->getPost('profession'),
            'interest'       => $this->request->getPost('interest'),
            'social_network' => $this->request->getPost('social_network'),
        ];

        $data['code_unique'] = bin2hex(random_bytes(16));
        $data['statut']      = 'en_attente';
        $data['role']        = 'invite';

        if ($this->userModel->insert($data)) {
            $this->generateQr($data['code_unique']);
            
            // L'envoi de l'email se fera de manière asynchrone via AJAX depuis la page du ticket
            // pour garantir une réponse instantanée à l'utilisateur.

            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success'  => true,
                    'redirect' => base_url("/ticket/{$data['code_unique']}"),
                    'message'  => "Félicitations ! Votre invitation a été générée."
                ]);
            }

            return redirect()->to("/ticket/{$data['code_unique']}")
                             ->with('success', "Félicitations ! Votre invitation a été générée.");
        }

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'errors' => $this->userModel->errors()
            ]);
        }

        return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
    }

    /**
     * Envoie l'invitation par email (Appelé via AJAX)
     */
    public function sendEmailAjax($code)
    {
        $invite = $this->userModel->where('code_unique', $code)->first();
        if (!$invite) return $this->response->setJSON(['status' => 'error']);

        $to = $invite['email'];
        $name = $invite['prenom'] . ' ' . $invite['nom'];

        $email = Services::email();
        $email->setTo($to);
        $email->setSubject('✨ Votre Invitation Officielle - Miss Maths - Miss Sciences 2026');
        
        $link = base_url("/ticket/$code");
        $qrPath = FCPATH . 'uploads/qrcodes/' . $code . '.png';
        $pdfPath = FCPATH . 'uploads/tickets/ticket_' . $code . '.pdf';

        // S'assurer que le dossier tickets existe
        if (!is_dir(FCPATH . 'uploads/tickets/')) {
            mkdir(FCPATH . 'uploads/tickets/', 0777, true);
        }

        // 1. Gérer le QR Code pour l'email 
        $cid = '';
        if (file_exists($qrPath)) {
            $email->attach($qrPath);
            $cid = $email->setAttachmentCID($qrPath);
        }

        // 2. Générer le PDF 
        try {
            $options = new Options();
            $options->set('isRemoteEnabled', true);
            $options->set('chroot', FCPATH);
            $dompdf = new Dompdf($options);
            
            //  la vue en PDF
            $html = view('emails/invitation_pdf', [
                'name' => $name,
                'telephone' => $invite['telephone'],
                'qrPath' => $qrPath,
                'code' => $code
            ]);
            
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            
            file_put_contents($pdfPath, $dompdf->output());
            
            // attach:personnalisation du nom du fichier PDF
            $email->attach($pdfPath, 'application/pdf', "Invitation_MissMaths_2026.pdf");
        } catch (\Exception $e) {
            log_message('error', 'Erreur PDF : ' . $e->getMessage());
        }
        
        // Template pour le message email
        $message = view('emails/invitation', [
            'name' => $name,
            'link' => $link,
            'cid'  => $cid
        ]);
        
        $email->setMessage($message);
        
        if ($email->send()) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            log_message('error', 'Erreur Email : ' . $email->printDebugger(['headers']));
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    /**
     * Affiche la page du ticket (QR Code)
     */
    public function success($code)
    {
        $data['invite'] = $this->userModel->where('code_unique', $code)->first();

        if (!$data['invite']) {
            return redirect()->to('/')->with('error', 'Invitation invalide.');
        }

        return view('public/ticket', $data);
    }

    /**
     * Logique de generation du QR Code.
     * Utilise la bibliotheque Endroid/QrCode pour creer une image PNG securisee
     * mkdir: creation du dossier qui va contenir les qr codes
     */
    
    private function generateQr($code)
    {
        $path = FCPATH . 'uploads/qrcodes/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        // L URL contenue dans le QR Code 
        $url = base_url("/admin/verify-scan?code=$code");

        $qrCode = QrCode::create($url);
        
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        
        $fileName = $code . '.png';
        $result->saveToFile($path . $fileName);

        // Mise a jour de la DB avec le chemin de l image pour l affichage du ticket
        $this->userModel->where('code_unique', $code)->set(['qr_path' => $fileName])->update();
    }

    private function mapCategoryToId($slug)
    {
        $mapping = [
            'cem'           => 1,
            'lycee'         => 2,
            'groupe_prive'  => 3,
            'communaute'    => 4
        ];

        return $mapping[$slug] ?? 4; // Par défaut communauté
    }
}
