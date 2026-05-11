<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'total_inscrits'   => $this->userModel->where('role', 'invite')->countAllResults(),
            'total_utilisees'  => $this->userModel->where('role', 'invite')->whereIn('statut', ['valide', 'scanne'])->countAllResults(),
            'total_en_attente' => $this->userModel->where('role', 'invite')->where('statut', 'en_attente')->countAllResults(),
        ];

        // pour
        $db = \Config\Database::connect();
        $builder = $db->table('utilisateurs');
        $builder->select('categories.nom as category_name, COUNT(utilisateurs.id) as count');
        $builder->join('categories', 'categories.id = utilisateurs.category_id', 'left');
        $builder->where('utilisateurs.role', 'invite');
        $builder->groupBy('utilisateurs.category_id');
        $stats = $builder->get()->getResultArray();
        
        $chartData = [
            'labels' => [],
            'data' => []
        ];
        foreach($stats as $stat) {
            $chartData['labels'][] = $stat['category_name'] ?: 'Non spécifié';
            $chartData['data'][] = $stat['count'];
        }
        $data['chartData'] = json_encode($chartData);

        return view('admin/dashboard', $data);
    }

    public function scanner()
    {
        return view('admin/scanner');
    }

    public function registrationQr()
    {
        $url = base_url('/'); // URL de la page d'inscription

        $qrCode = \Endroid\QrCode\QrCode::create($url)
            ->setEncoding(new \Endroid\QrCode\Encoding\Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new \Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow())
            ->setSize(400) // Plus grand pour une meilleure qualité
            ->setMargin(0)
            ->setRoundBlockSizeMode(new \Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin())
            ->setForegroundColor(new \Endroid\QrCode\Color\Color(0, 0, 0))
            ->setBackgroundColor(new \Endroid\QrCode\Color\Color(255, 255, 255));

        $writer = new \Endroid\QrCode\Writer\PngWriter();
        $result = $writer->write($qrCode);

        // Convertir en base64 pour l'intégrer dans la vue HTML
        $dataUri = $result->getDataUri();

        return view('public/qr_poster', ['qrImage' => $dataUri, 'url' => $url]);
    }
}
