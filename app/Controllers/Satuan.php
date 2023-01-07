<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSatuan;
class Satuan extends BaseController
{
    public function __construct()
    {
        $this->ModelSatuan = new ModelSatuan();
    }

    public function index()
    {
        $satuan = $this->ModelSatuan->getData();
        $data = [
            'judul' => 'Master Data',
            'subjudul' => 'Satuan',
            'menu' => 'masterdata',
            'submenu' => 'satuan',
            'page' =>  'v_satuan',
            'satuan' => $satuan
        ];
        return view('v_template',$data);
    }
    public function create(){
        $this->ModelSatuan->insert([
            'nama_satuan' => $this->request->getVar('nama_satuan'),
        ]);
        session()->setFlashData('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/satuan');
    }
    public function delete($id){
        $this->ModelSatuan->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/satuan');
    }
    public function update($id){
        $this->ModelSatuan->save([
            'id' => $id,
            'nama_satuan' => $this->request->getVar('nama_satuan'),
            
        ]);
        session()->setFlashData('pesan', 'Data berhasil di ubah');
        return redirect()->to('/satuan');
    }
}
