<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelProduk;
use App\Models\ModelCart;
use App\Models\ModelTransaksi;

class Penjualan extends BaseController
{
    public function __construct()
    {
        $this->ModelProduk = new ModelProduk();
        $this->ModelCart = new ModelCart();
        $this->ModelTransaksi = new ModelTransaksi();
    }
    public function index()
    {
        $product = $this->ModelProduk->getData();
        $cart = $this->ModelCart->getData();
       $gatot= $this->ModelCart->grandTotal();
       $nama_produk= $this->ModelCart->getProduk();
        $data = [
            'judul' =>  'Penjualan',
            'product' => $product,
            'cart' => $cart,
            'grand'=>$gatot,
            'nama_produk'=>$nama_produk
        ];
        return view('v_penjualan',$data);
    }
    public function addtocart(){
        $this->ModelCart->insert(array(
            'id_produk' => $this->request->getVar('id_produk'),
            'nama_barang' => $this->request->getVar('nama_barang'),
            'harga' => $this->request->getVar('harga'),
            'qty' => $this->request->getVar('qty'),
            'total' => $this->request->getVar('total'),
        ));
            session()->setFlashData('pesan', 'Data berhasil ditambahkan ke keranjang');
            return redirect()->to('/penjualan');
        
    }
    public function viewDataProduk(){
        if($this->request->isAJAX()){
            $msg = [
                'viewmodal'=>view('/v_modalproduk')
            ];
            echo json_encode($msg);
        }
    }
    public function Transaksi(){
        $cart = $this->ModelCart->getItems();
        $items = json_encode($cart);
        $this->ModelTransaksi->insert([
            'nama_kasir' => $this->request->getVar('nama_kasir'),
            'nama_pembeli' => $this->request->getVar('nama_pembeli'),
            'items' => $items,
            'grand_total' => $this->request->getVar('grand'),
        ]);
        $this->ModelCart->afterPayments();
        session()->setFlashData('pesan', 'Data Masuk Transaksi');
            return redirect()->to('/penjualan');
    }
    public function delete($id){
        $this->ModelCart->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/penjualan');
    }
}
