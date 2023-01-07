<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelUser;

class User extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }

    public function index()
    {
        $user = $this->ModelUser->getData();
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'User',
            'menu' => 'masterdata',
            'submenu' => 'user',
            'page' =>  'v_user',
            'user' => $user
        ];
        return view('v_template',$data);
    }

    
    public function create(){
        $this->ModelUser->insert([
            'nama_user' => $this->request->getVar('nama_user'),
            'email' => $this->request->getVar('email'),
            'password' => sha1($this->request->getVar('password')) ,
            'level' => $this->request->getVar('level'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/user');
    }
    public function delete($id){
        $this->ModelUser->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/user');
    }
    public function update($id){
        $this->ModelUser->save([
            'id' => $id,
            'nama_user' => $this->request->getVar('nama_user'),
            'email' => $this->request->getVar('email'),
            'level' => $this->request->getVar('level'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil di ubah');
        return redirect()->to('/user');
    }
}
