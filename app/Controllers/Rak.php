<?php

namespace App\Controllers;


class Rak extends BaseController
{
    
    public function index()
    {
        // return "test";
        $Rak = model("Rak");        
        return view('RakView', [
            'data' => $Rak->getAll()
        ]);
    }

    public function Search()
    {
        $rak = model("Rak");
        if($this->request->getVar('search') && $this->request->getVar('search') != ''){
            $rak = $rak->where('nama_rak', $this->request->getVar('search'));
        }
        $rak = $rak->find();
        return view('rakView', [
            'data' => $rak
        ]);
    }
    
    public function Tambah()
    {
        $dataRak = model("Rak");
        return view('TambahRak', [
            'dataRak' => $dataRak->findAll(),
            'action' => base_url().'/Rak/DoTambahRak'
        ]);
    }

    public function DoTambahRak()
    {
        $data = $this->request->getPost();
        $rak = model("Rak");
        if(!$rak->where('nama_rak', $this->request->getVar('nama_rak'))->find()) {
            $rak->insert($data);
        }
        return redirect()->to(base_url('Rak'));
    }

    public function EditRak($id)
    {       
        $rak = model("Rak");
        $rak = $rak->where('id_rak', $id)->first();
        return view('TambahRak', [
            'dataRak' => $rak,
            'action' => base_url().'/Rak/DoEdit/'.$id
        ]);
    }

    public function DoEdit($id)
    {

        $data = $this->request->getPost();
        $rak = model("Rak");
        $rak = $rak->where('id_rak', $id);
        $rak->update($id, $data);
       
        return redirect()->to(base_url('Rak'));
    }

    public function HapusRak($id)
    {
        $a = model("Rak");
        $a->where('id_rak', $id)->delete();
        return redirect()->to(base_url('Rak'));
    }
}
