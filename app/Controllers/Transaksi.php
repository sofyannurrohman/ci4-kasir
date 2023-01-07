<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;

class Transaksi extends BaseController
{
    public function __construct()
    {
        $this->ModelTransaksi = new ModelTransaksi();
    }
    public function index()
    {
        $transaksi = $this->ModelTransaksi->getData();

        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Transaksi',
            'menu' => 'masterdata',
            'submenu' => 'transaksi',
            'page' =>  'v_transaksi',
            'transaksi'=> $transaksi,
        ];
        return view('v_template',$data);
    }

    public function delete($id){
        $this->ModelTransaksi->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/transaksi');
    }
    public function update($id){
        $this->ModelTransaksi->save([
            'id' => $id,
            'nama_transaksi' => $this->request->getVar('nama_transaksi'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil di ubah');
        return redirect()->to('/transaksi');
    }
}
