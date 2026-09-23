<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Profil;

class JurusanPublicController extends Controller
{
    /**
     * Ambil data jurusan berdasarkan potongan nama (like), lalu siapkan
     * data guru terkait jurusan tersebut. Dipakai bersama oleh keempat
     * method di bawah supaya tidak duplikasi kode.
     */
    private function loadJurusanData(string $keyword): array
    {
        $jurusan = Jurusan::where('nama_jurusan', 'like', "%{$keyword}%")->first();

        $guru = $jurusan
            ? Guru::where('jurusan_id', $jurusan->id)->get()
            : collect();

        $profil = Profil::first();

        return compact('jurusan', 'guru', 'profil');
    }

    /**
     * Halaman detail jurusan: Teknik Kendaraan Ringan (TKR) / Otomotif.
     */
    public function tkr()
    {
        return view('jurusan.tkr', $this->loadJurusanData('Otomotif'));
    }

    /**
     * Halaman detail jurusan: Pemasaran / Bisnis Daring dan Pemasaran.
     */
    public function pms()
    {
        return view('jurusan.pms', $this->loadJurusanData('Pemasaran'));
    }

    /**
     * Halaman detail jurusan: PPLG (Pengembangan Perangkat Lunak dan Gim).
     */
    public function pplg()
    {
        return view('jurusan.pplg', $this->loadJurusanData('PPLG'));
    }

    /**
     * Halaman detail jurusan: APHP (Agribisnis Pengolahan Hasil Pertanian).
     */
    public function aphp()
    {
        return view('jurusan.aphp', $this->loadJurusanData('APHP'));
    }
}