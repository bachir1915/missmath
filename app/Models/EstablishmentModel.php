<?php

namespace App\Models;

use CodeIgniter\Model;

class EstablishmentModel extends Model
{
    protected $table            = 'establishments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'quota', 'type', 'ief'];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Retourne le nombre de places restantes pour un établissement donné
     */
    public function getRemainingSeats($name)
    {
        $est = $this->where('name', $name)->first();
        if (!$est) return null;

        $db = \Config\Database::connect();
        $count = $db->table('utilisateurs')
                    ->where('establishment', $name)
                    ->countAllResults();

        return $est['quota'] - $count;
    }
}
