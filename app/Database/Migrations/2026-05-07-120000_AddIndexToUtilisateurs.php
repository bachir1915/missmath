<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddIndexToUtilisateurs extends Migration
{
    public function up()
    {
        // Ajout d'index sur les colonnes de recherche fréquentes pour booster les performances
        $this->db->query("ALTER TABLE utilisateurs ADD INDEX idx_establishment (establishment)");
        $this->db->query("ALTER TABLE utilisateurs ADD INDEX idx_category_id (category_id)");
        $this->db->query("ALTER TABLE utilisateurs ADD INDEX idx_statut (statut)");
    }

    public function down()
    {
        $this->db->query("ALTER TABLE utilisateurs DROP INDEX idx_establishment");
        $this->db->query("ALTER TABLE utilisateurs DROP INDEX idx_category_id");
        $this->db->query("ALTER TABLE utilisateurs DROP INDEX idx_statut");
    }
}
