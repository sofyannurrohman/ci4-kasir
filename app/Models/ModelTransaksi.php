<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table = 'transaksi';
    protected $allowedFields = ['id','nama_kasir','nama_pembeli','items','grand_total'];

    public function getData($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function countRow(){
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getResultObject();
    }
    public function countPendapatan(){
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->selectSum('grand_total');
        $query = $builder->get();
        return $query->getResult();
    }
    public function getItems(){
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $builder->select('items');
        $query = $builder->get();
        return $query->getResultObject();
    }
    public function getProduk($id_produk){
        $db      = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->select('nama_produk');
        $builder->join('transaksi', '{$id_produk} = produk.id');
        $query = $builder->get();
        return $query->getResult();
    }
}
