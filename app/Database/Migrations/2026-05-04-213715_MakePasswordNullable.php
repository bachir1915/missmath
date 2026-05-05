<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MakePasswordNullable extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('utilisateurs', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('utilisateurs', [
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
        ]);
    }
}
