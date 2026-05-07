<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateEstablishmentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'        => ['type' => 'VARCHAR', 'constraint' => 255],
            'quota'       => ['type' => 'INT', 'constraint' => 11, 'default' => 4],
            'type'        => ['type' => 'ENUM', 'constraint' => ['lycee', 'cem', 'prive', 'special']],
            'ief'         => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('name');
        $this->forge->createTable('establishments');
    }

    public function down()
    {
        $this->forge->dropTable('establishments');
    }
}
