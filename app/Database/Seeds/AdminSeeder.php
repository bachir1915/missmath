<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
class AdminSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('utilisateurs')->insert([
            'nom'         => 'Admin',
            'prenom'      => 'Super',
            'email'       => 'admin@missmath.sn',
            'telephone'   => '+221770000000',
            'password'    => password_hash('admin123', PASSWORD_DEFAULT),
            'role'        => 'admin',
            'statut'      => 'valide',
            'code_unique' => bin2hex(random_bytes(16)),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
