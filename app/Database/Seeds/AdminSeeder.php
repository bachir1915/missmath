<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
class AdminSeeder extends Seeder
{
    public function run()
    {
        $builder = $this->db->table('utilisateurs');
        //admin par defaut
        $builder->where('role', 'admin')->delete();

        $builder->insert([
            'nom'         => 'Bousso',
            'prenom'      => 'Mouhamed Bachir',
            'email'       => 'bachirbousso10@gmail.com',
            'telephone'   => '772039150',
            'password'    => password_hash('passer123', PASSWORD_DEFAULT),
            'role'        => 'admin',
            'statut'      => 'valide',
            'code_unique' => bin2hex(random_bytes(16)),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
