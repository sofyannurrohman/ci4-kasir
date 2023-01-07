<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelCart extends Model
{
    protected $table = 'cart';
    protected $allowedFields = ['id','nama_pembeli','nama_barang','id_produk','harga','qty','total'];
   

    public function getData($id = false){
        if ($id == false){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }

    public function grandTotal(){
        $db      = \Config\Database::connect();
        $builder = $db->table('cart');
        $builder->selectSum('total');
        $query = $builder->get();
        return $query->getResultObject();   
    }
    public function getItems(){
        $db      = \Config\Database::connect();
        $builder = $db->table('cart');
        $builder->select('id_produk,nama_barang,qty');
        $query = $builder->get();
        
        return $query->getResult();
    }
    public function afterPayments(){
        $db      = \Config\Database::connect();
        $builder = $db->table('cart');
        $builder->emptyTable('cart');
    }
    public function getProduk(){
        $db      = \Config\Database::connect();
        $builder = $db->table('produk');
        $builder->select('nama_produk');
        $builder->join('cart', 'cart.id_produk = produk.id');
        $query = $builder->get();
        return $query->getResult();
    }
}
