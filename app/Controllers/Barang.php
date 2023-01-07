<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduk;

class Barang extends BaseController
{
    public function __construct()
    {
        $this->ModelProduk = new ModelProduk();
    }
    public function index()
    {
        $produk = $this->ModelProduk->getData();
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Produk',
            'menu' => 'masterdata',
            'submenu' => 'produk',
            'page' =>  'v_barang',
            'produk'=> $produk
        ];
        return view('v_template',$data);
    }

     
    public function create(){
        $this->ModelProduk->insert([
            'nama_produk' => $this->request->getVar('nama_produk'),
            'id_satuan' => $this->request->getVar('id_satuan'),
            'harga_beli' => $this->request->getVar('harga_beli'),
            'harga_jual' => $this->request->getVar('harga_jual'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/produk');
    }
    public function delete($id){
        $this->ModelProduk->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/produk');
    }
    public function update($id){
        $this->ModelProduk->save([
            'id' => $id,
            'nama_produk' => $this->request->getVar('nama_produk'),
            'id_satuan' => $this->request->getVar('id_satuan'),
            'harga_beli' => $this->request->getVar('harga_beli'),
            'harga_jual' => $this->request->getVar('harga_jual'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil di ubah');
        return redirect()->to('/produk');
    }
    
}
