<?php

namespace App\Controllers;

// deklarasi class Buku memiliki sifat keturuan dari BaseController
class Buku extends BaseController
{
    // deklarasi method index(), berfungsi sebagai method index
    public function index()
    {
        // deklarasi variable buku, untuk memanggil model Buku
        $buku = model("Buku");

        // return halaman BukuView dengan variable data berisi hasil dari pemanggilan method getAll() dari model Buku
        return view('BukuView', [
            'data' => $buku->getAll()
        ]);
    }

    // deklarasi method Search() untuk mencari data Buku berdasarkan kode_buku petugas
    public function Search()
    {
        // deklarasi variable buku, untuk memanggil model Buku
        $buku = model("Buku");
        // deklaraasi kondisi jika parameter get index search ada dan tidak sama dengan string kosong, 
        if($this->request->getVar('search') && $this->request->getVar('search') != ''){
            // maka query akan ditambah dengan where kode_buku sama dengan variable get index search
            $buku = $buku->where('kode_buku', $this->request->getVar('search'));
        }
        // memanggil fungsi find() yang artinya hasil dari query memungkinkan ada banyak data
        $buku = $buku->find();
        
        // return halaman BukuView dengan variable data berisi buku dengan kode_buku sama dengan variable get index search 
        return view('BukuView', [
            'data' => $buku
        ]);
    }

    // deklarasi method Tambah(), method ini akan berfungsi untuk menambah data Rak 
    public function Tambah()
    {
        // deklarasi variable dataRak, untuk memanggil model Rak
        $dataRak = model("Rak");

        // return halaman TambahBuku dengan action action berisi link url / tujuan kemana form DoTambahBuku akan di kirim.  
        // '/Buku/DoTambahBuku' artinya form akan disubmit ke controller Buku dan fungsi DoTambahBuku() yang akan dijelaskan setelah fungsi ini (Tambah())
        // dan dataRat berisi semua list buku
        return view('TambahBuku', [
            'dataRak' => $dataRak->findAll(),
            'action' => base_url().'/Buku/DoTambahBuku'
        ]);
    }

    // deklarasi method DoTambahBuku(), berfungsi sebagai action yang akan kita lakukan pada saat mensubmit form tambah buku
    public function DoTambahBuku()
    {
        // variable data berisikan parameter-parameter yang ada di form buku yang terkirim ke method ini
        $data = $this->request->getPost();
        // deklarasi variable buku, untuk memanggil model Buku
        $buku = model("Buku");
        // kondisi jika kode_buku blm ada di dalam database, maka program akan insert, jika sudah tidak akan insert apapun
        if(!$buku->where('kode_buku', $this->request->getVar('kode_buku'))->find()) {
            $buku->insert($data);
        }

        // saat semua proses selesai, redirect ke menu list buku
        return redirect()->to(base_url('Buku'));
    }

    // deklarasi method HapusBuku(), berfungsi untuk menghapus buku berdasarkan id buku
    public function HapusBuku($id)
    {
        // seperti biasa kita panggil model buku disini, dan di deklarasikan sebagai variable buku
        $buku = model("Buku");
        // cari Buku dengan id_buku sama dengan variable id, dan langsung menghapusnya jika menemukan data
        $buku->where('id_buku', $id)->delete();

        // saat semua proses selesai, redirect ke menu list Buku
        return redirect()->to(base_url('Buku'));
    }

    // deklarasi method EditBuku(), berfungsi untuk menampilkan halaman form edit buku berserta data2 buku yang dipilih untuk diedit
    public function EditBuku($id)
    {
        // seperti biasa kita panggil model Rak disini, dan di deklarasikan sebagai variable rak
        $dataRak = model("Rak");
        // seperti biasa kita panggil model buku disini, dan di deklarasikan sebagai variable buku
        $buku = model("Buku");
        // cari Buku dengan id_buku sama dengan variable id, yang nantinya akan ditampilkan pada view EditBuku
        $buku = $buku->where('id_buku', $id)->first();

        // tampilkan halaman / view TambahBuku dengan data $dataRak dan $dataBuku yang dipilih, dan data action berisi url kemana form TambahBuku akan dikirim
        // jika diperhatikan kita sengaja menggunakan view TambahBuku sebagai edit dan add sekaligus agar hemat resource, yang jadi pembeda adalah actionnya kemana data form tersebut akan dikirim yaitu pada data action
        return view('TambahBuku', [
            'dataBuku' => $buku,
            'dataRak' => $dataRak->findAll(),
            'action' => base_url().'/Buku/DoEdit/'.$id
        ]);
    }

    // deklarasi method DoEdit(), berfungsi sebagai action yang akan kita lakukan pada saat mensubmit form edit buku dikirim
    public function DoEdit($id)
    {
        // variable data berisikan parameter-parameter yang ada di form buku yang terkirim ke method ini
        $data = $this->request->getPost();
        // seperti biasa kita panggil model buku disini, dan di deklarasikan sebagai variable buku
        $buku = model("Buku");
        // cari buku dengan id_buku sama dengan variable id, dan langsung menghapusnya jika menemukan data
        $buku = $buku->where('id_buku', $id);
        // update data yang ditemukan dengan parameter form 
        $buku->update($id, $data);

        // saat semua proses selesai, redirect ke menu list buku
        return redirect()->to(base_url('Buku'));
    }
}
