<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduk;
use App\Models\ModelTransaksi;
use App\Models\ModelUser;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->ModelProduk = new ModelProduk();
        $this->ModelTransaksi = new ModelTransaksi();
        $this->ModelUser = new ModelUser();
    }
    
    public function index()
    {
        $tp = $this->ModelProduk->countRow();
        $tt = $this->ModelTransaksi->countRow();
        $tu = $this->ModelUser->countRow();
        $tpn = $this->ModelTransaksi->countPendapatan();
        $data = [
            'judul' => 'Dashboard',
            'subjudul' => '',
            'menu' => 'dashboard',
            'submenu' => '',
            'page' =>  'v_admin',
            'total_produk'=> $tp,
            'total_transaksi'=> $tt,
            'total_user'=> $tu,
            'total_pendapatan'=> $tpn
        ];
        return view('v_template',$data);
    }
   
    
}
