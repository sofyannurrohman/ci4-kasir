<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama_user','email','password','level'];


    public function getData($id = false){
        if ($id == false){
            return $this->findAll();
        }
        return $this->where(['id' => $id])->first();
    }
    public function LoginUser($email,$password){
        return $this->db->table('user')
        ->where([
            'email'=> $email,
            'password'=> $password
        ])->get()->getRowArray();
    }
    public function countRow(){
        $db      = \Config\Database::connect();
        $builder = $db->table('user');
        $builder->selectCount('id');
        $query = $builder->get();
        return $query->getResultObject();
    }
}
