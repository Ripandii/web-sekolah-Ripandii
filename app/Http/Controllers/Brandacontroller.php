<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Beranda;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    use HandlesUploads;

    /**
     * Beranda/Tentang Kami adalah data tunggal (cuma 1 baris).
     */
    public function update(Request $request)
    {
        $data = $this->handleUploads($request, 'beranda');

        $beranda = Beranda::first() ?? new Beranda();
        $beranda->fill($data);
        $beranda->save();

        return back()->with('success', 'Beranda berhasil diperbarui.');
    }
}