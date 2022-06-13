<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;


class Pengembalian extends BaseController
{
    // deklarasi method index(), berfungsi sebagai method index
    public function index()
    {
        $dataPeminjaman = model('Peminjaman') // deklarasi variable dataPeminjaman dan memanggil model Peminjaman
            ->join('Anggota', 'Peminjaman.id_anggota = Anggota.id_anggota') // join ke tabel anggota dengan Peminjaman.id_anggota sama dengan Anggota.id_anggota
            ->join('Buku', 'Peminjaman.id_buku = Buku.id_buku') // join ke tabel Buku dengan Peminjaman.id_buku sama dengan Buku.id_buku
            ->join('Rak', 'Rak.id_rak = Buku.id_rak') // join ke tabel Rak dengan Peminjaman.id_rak sama dengan Rak.id_rak
            ->join('pengembalian', 'id_peminjaman = id_pinjam') // join ke tabel Buku dengan Peminjaman.id_buku sama dengan Buku.id_buku
            ->orderBy('id_peminjaman') // order by id_peminjaman asc
            ->find(); // get semua data sesuai kriteria

        // return halaman PengembalianBukuView dengan data dataPeminjaman
        return view('PengembalianBukuView', [
            'data' => $dataPeminjaman
        ]);
    }

    // deklarasi method Search() untuk mencari data Peminjaman berdasarkan username petugas
    public function Search()
    {
        $dataPeminjaman = model('Peminjaman');  // deklarasi variable dataPeminjaman dan memanggil model Peminjaman
        $dataPeminjaman = $dataPeminjaman->join('Anggota', 'Peminjaman.id_anggota = Anggota.id_anggota');  // join ke tabel anggota dengan Peminjaman.id_anggota sama dengan Anggota.id_anggota
        $dataPeminjaman = $dataPeminjaman->join('Buku', 'Peminjaman.id_buku = Buku.id_buku');  // join ke tabel Buku dengan Peminjaman.id_buku sama dengan Buku.id_buku
        $dataPeminjaman = $dataPeminjaman->join('Rak', 'Rak.id_rak = Buku.id_rak');  // join ke tabel Rak dengan Rak.id_rak sama dengan Buku.id_rak
        $dataPeminjaman = $dataPeminjaman->join('pengembalian', 'id_peminjaman = id_pinjam');  // join ke tabel pengembalian dengan id_peminjaman sama dengan id_pinjam
        if($this->request->getVar('search') && $this->request->getVar('search') != ''){ // deklaraasi kondisi jika parameter get index search ada dan tidak sama dengan string kosong, 
            $dataPeminjaman = $dataPeminjaman->where('kode_peminjaman', $this->request->getVar('search')); // maka query akan ditambah dengan where kode_peminjaman sama dengan variable get index search
        }
        $dataPeminjaman = $dataPeminjaman->orderBy('id_peminjaman'); // order by id_peminjaman asc
        $dataPeminjaman = $dataPeminjaman->find(); // get all data sesuai kriteria
        
        // return halaman PengembalianBukuView dengan data dataPeminjaman
        return view('PengembalianBukuView', [
            'data' => $dataPeminjaman
        ]);
    }
}
