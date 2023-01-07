<?php

namespace App\Controllers;
use App\Models\ModelUser;
class Home extends BaseController
{
    public function __construct()
    {
        $this->ModelUser = new ModelUser();
    }
    public function index()
    {
        $data = [
            'judul' =>  'Login'
        ];
        return view('v_login',$data);
    }
    public function login(){
          if ($this->validate([
            'email'=>[
                'label'=>'email',
                'rules'=>'required',
                'errors'=> [
                    'required'=>"{field} Masih Kosong!",
                ]
            ],
            'password'=>[
                'label'=>'password',
                'rules'=>'required',
                'errors'=> [
                    'required'=>"{field} Masih Kosong!",
            ]
                ]])) {
            $email = $this->request->getPost('email');
            $password = sha1($this->request->getPost('password'));
            $cek_login = $this->ModelUser->LoginUser($email,$password);
            if($cek_login){
                $dataSesi=[
                    'id' => $cek_login['id'],
                    'nama_user'=> $cek_login['nama_user'],
                    'level'=> $cek_login['level'],
                ];
                session()->set($dataSesi);
                if(session()->get('level')==1){
                    return redirect()->to('/admin');
                }elseif(session()->get('level')==2){
                    return redirect()->to('/penjualan');
                }
            }else{
                session()->setFlashdata('gagal', "Email/Password Salah !!");
                return redirect()->to('/');
            }
          }else{
                session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
                return redirect()->to("/")->withInput('validation',\Config\Services::validation());
          }
    }
    public function logout(){
        session()->remove('id');
        session()->remove('nama_user');
        session()->remove('level');
        session()->setFlashdata('pesan','Anda berhasil Logout');
        return redirect()->to('/');
    }
}
