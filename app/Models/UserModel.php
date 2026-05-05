<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'utilisateurs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nom', 'prenom', 'email', 'telephone', 'password', 'role', 
        'statut', 'code_unique', 'qr_path', 'category_id', 'establishment', 
        'class', 'profession', 'interest', 'social_network'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Règles de validation pour sécuriser l'inscription
    protected $validationRules      = [
        'email'     => 'required|valid_email|is_unique[utilisateurs.email]',
        'telephone' => 'required|regex_match[/^(\+)[0-9\s]{8,18}$/]|is_unique[utilisateurs.telephone]',
        'password'  => 'permit_empty|min_length[6]',
        'nom'       => 'required',
        'prenom'    => 'required',
        'category_id' => 'permit_empty|is_natural_no_zero|less_than_equal_to[4]',
    ];

    // Messages d'erreur personnalisés si la validation échoue
    protected $validationMessages   = [
        'email' => [
            'is_unique'   => 'Cet email est déjà utilisé par un autre compte.',
            'valid_email' => 'Veuillez entrer une adresse email valide.'
        ],
        'telephone' => [
            'is_unique'   => 'Ce numéro de téléphone est déjà utilisé par un autre compte.',
            'regex_match' => 'Le format du téléphone doit être international (ex: +221 77 000 00 00).'
        ],
        'password' => [
            'min_length' => 'Le mot de passe doit contenir au moins 6 caractères.'
        ]
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = ['normalizeData', 'hashPassword'];
    protected $beforeUpdate   = ['normalizeData', 'hashPassword'];

    // permet de normaliser les données avant insertion ou mise à jour (mettre en minuscule l'email et supprimer les espaces)
    protected function normalizeData(array $data)
    {
        if (isset($data['data']['email'])) {
            $data['data']['email'] = trim(strtolower($data['data']['email']));
        }
        if (isset($data['data']['telephone'])) {
            $data['data']['telephone'] = trim($data['data']['telephone']);
        }
        return $data;
    }

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
}
