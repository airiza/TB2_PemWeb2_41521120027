<?php

namespace App\Models;

use CodeIgniter\Model;

class Rak extends Model
{
    protected $table      = 'rak';
    protected $returnType = "object";

    protected $allowedFields = [
        //'id_rak',
        'nama_rak',
        'lokasi_rak'
    ];

    // Validation
    protected $validationRules = [
        'nama_rak' => "required",
        'lokasi_rak' => "required"
    ];

    public function getAll(){
        $builder = $this->db->table('rak');
        $query = $builder->get();
        return $query->getResult();
    }

}