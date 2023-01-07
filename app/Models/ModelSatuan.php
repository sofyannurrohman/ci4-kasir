<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSatuan extends Model
{
    protected $table = 'satuan';
    protected $allowedFields = ['nama_satuan'];


    public function getData($id = false){
        if ($id == false){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
}
