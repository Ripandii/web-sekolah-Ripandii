<?php

namespace App\Http\Controllers;

use App\Models\Ekstrakurikuler;
use App\Models\Profil;

class EkskulController extends Controller
{
    private function loadEkskulData(string $keyword): array
    {
        $ekskul = Ekstrakurikuler::where('nama_ekskul', 'like', "%{$keyword}%")->first();
        $profil = Profil::first();

        return compact('ekskul', 'profil');
    }

    public function rohis()
    {
        return view('ekstrakurikuler.rohis', $this->loadEkskulData('Rohis'));
    }

    public function cinemak()
    {
        return view('ekstrakurikuler.cinemak', $this->loadEkskulData('Cinemak'));
    }

    public function voli()
    {
        return view('ekstrakurikuler.voli', $this->loadEkskulData('Voli'));
    }

    public function pmr()
    {
        return view('ekstrakurikuler.pmr', $this->loadEkskulData('PMR'));
    }

    public function karawitan()
    {
        return view('ekstrakurikuler.karawitan', $this->loadEkskulData('Karawitan'));
    }

    public function futsal()
    {
        return view('ekstrakurikuler.futsal', $this->loadEkskulData('Futsal'));
    }

    public function pramuka()
    {
        return view('ekstrakurikuler.pramuka', $this->loadEkskulData('Pramuka'));
    }

    public function paskibra()
    {
        return view('ekstrakurikuler.paskibra', $this->loadEkskulData('Paskibra'));
    }

    public function marchingband()
    {
        return view('ekstrakurikuler.marchingband', $this->loadEkskulData('Marching Band'));
    }

    public function jepang()
    {
        return view('ekstrakurikuler.jepang', $this->loadEkskulData('Jepang'));
    }
}