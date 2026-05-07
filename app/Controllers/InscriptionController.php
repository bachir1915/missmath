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

        // --- Vérification finale du Quota (Sécurité Serveur) ---
        if (isset($data['establishment']) && !empty($data['establishment'])) {
            $estModel = new \App\Models\EstablishmentModel();
            $remaining = $estModel->getRemainingSeats($data['establishment']);
            
            // Si l'établissement existe en base et que le quota est atteint
            if ($remaining !== null && $remaining <= 0) {
                if ($this->request->isAJAX()) {
                    return $this->response->setJSON([
                        'success' => false,
                        'errors' => ['quota' => "Désolé, le quota pour cet établissement ({$data['establishment']}) est déjà atteint."]
                    ]);
                }
                return redirect()->back()->withInput()->with('error', "Le quota pour cet établissement est atteint.");
            }
        }

        $data['code_unique'] = bin2hex(random_bytes(16));
        $data['statut']      = 'en_attente';
        $data['role']        = 'invite';

        if ($this->userModel->insert($data)) {
            $this->generateQr($data['code_unique']);
            
            // Envoi immédiat de l'invitation par email (automatique et optimisé)
            $this->sendInvitationEmail($data['code_unique']);

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
     * Envoie l'invitation par email (appelé directement depuis submit)
     */
    private function sendInvitationEmail($code)
    {
        $invite = $this->userModel->where('code_unique', $code)->first();
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

        // Attacher le QR Code
        $cid = '';
        if (file_exists($qrPath)) {
            $email->attach($qrPath);
            $cid = $email->setAttachmentCID($qrPath);
        }

        // Générer le PDF s'il n'existe pas encore
        if (!file_exists($pdfPath)) {
            try {
                $options = new Options();
                $options->set('isRemoteEnabled', false); // Désactivé pour la rapidité
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

        // Attacher le PDF s'il est disponible
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
        } else {
            log_message('info', 'Email envoyé avec succès à : ' . $to);
        }
    }

    /**
     * Envoie l'invitation par email (Appelé via AJAX - gardé pour compatibilité)
     */
    /**
     * Vérifie le quota restant pour un établissement (AJAX)
     */
    public function checkQuota()
    {
        $name = $this->request->getPost('establishment');
        if (!$name) return $this->response->setJSON(['status' => 'error']);

        $estModel = new \App\Models\EstablishmentModel();
        $remaining = $estModel->getRemainingSeats($name);

        return $this->response->setJSON([
            'status' => 'success',
            'remaining' => $remaining
        ]);
    }

    /**
     * Récupère la liste des établissements avec leurs quotas (AJAX)
     */
    public function getEstablishments()
    {
        $type = $this->request->getGet('type'); // 'cem' ou 'lycee'
        if (!$type) return $this->response->setJSON([]);

        $cache = \Config\Services::cache();
        $cacheKey = "establishments_list_{$type}";
        
        // Tentative de récupération depuis le cache
        if ($cachedData = $cache->get($cacheKey)) {
            return $this->response->setJSON($cachedData);
        }

        $estModel = new \App\Models\EstablishmentModel();
        $establishments = $estModel->where('type', $type)
                                   ->orderBy('ief', 'ASC')
                                   ->orderBy('name', 'ASC')
                                   ->findAll();

        $db = \Config\Database::connect();
        // On récupère les comptes en une seule requête (Optimisation Performance)
        $counts = $db->table('utilisateurs')
                     ->select('establishment, COUNT(*) as total')
                     ->whereIn('establishment', array_column($establishments, 'name'))
                     ->groupBy('establishment')
                     ->get()
                     ->getResultArray();
        
        $countMap = array_column($counts, 'total', 'establishment');

        // On calcule les places restantes pour chaque établissement
        foreach ($establishments as &$est) {
            $currentCount = $countMap[$est['name']] ?? 0;
            $est['remaining'] = $est['quota'] - $currentCount;
        }

        // Mise en cache pour 5 minutes (300 secondes)
        $cache->save($cacheKey, $establishments, 300);

        return $this->response->setJSON($establishments);
    }

    public function sendEmailAjax($code)
    {
        // Envoi de l'invitation en arrière-plan
        $this->sendInvitationEmail($code);
        
        return $this->response->setJSON(['status' => 'success']);
    }

    /**
     * Affiche la page du ticket (QR Code)
     */
    public function success($code)
    {
        $invite = $this->userModel->where('code_unique', $code)->first();

        if (!$invite) {
            return redirect()->to('/')->with('error', 'Invitation invalide.');
        }

        $estModel = new \App\Models\EstablishmentModel();
        $remaining = $estModel->getRemainingSeats($invite['establishment']);

        return view('public/ticket', [
            'invite'    => $invite,
            'remaining' => $remaining
        ]);
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

        // URL publique de scan - accessible par TOUT appareil sans connexion
        $url = base_url("/scan?code=$code");

        $qrCode = QrCode::create($url)
            ->setSize(400)
            ->setMargin(10);
        
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
