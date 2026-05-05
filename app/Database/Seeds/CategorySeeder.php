<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nom'  => 'CEM',
                'slug' => 'cem',
            ],
            [
                'nom'  => 'Lycée',
                'slug' => 'lycee',
            ],
            [
                'nom'  => 'Groupe Scolaire Privé',
                'slug' => 'groupe_prive',
            ],
            [
                'nom'  => 'Communauté',
                'slug' => 'communaute',
            ],
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
