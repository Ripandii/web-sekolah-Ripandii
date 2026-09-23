<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profil;

class ProfilController extends Controller
{
    public function update(Request $request)
    {
        $profil = Profil::first() ?? new Profil();

        // sesuaikan nama field dengan kolom di tabel/database Anda
        $data = $request->validate([
            'nama_sekolah' => 'nullable|string',
            'alamat'       => 'nullable|string',
            // tambahkan field lain sesuai form profil Anda
        ]);

        $profil->fill($data);
        $profil->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}