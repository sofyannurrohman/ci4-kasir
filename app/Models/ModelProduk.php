<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelProduk extends Model
{
    protected $table = 'produk';
    protected $allowedFields = ['nama_produk','id_satuan','harga_beli','harga_jual','stock'];


    public function getData($id = false){
        if ($id == false){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function countRow(){
        $db      = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getResultObject();
    }
}
