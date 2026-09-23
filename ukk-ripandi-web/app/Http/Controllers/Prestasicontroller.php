<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Prestasi;
use Illuminate\Http\Request;

class PrestasiController extends Controller
{
    use HandlesUploads;

    public function store(Request $request)
    {
        $data = $this->handleUploads($request, 'prestasi');

        Prestasi::create($data);

        return back()->with('success', 'Prestasi berhasil ditambahkan.');
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $data = $this->handleUploads($request, 'prestasi');

        $prestasi->fill($data);
        $prestasi->save();

        return back()->with('success', 'Prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        $prestasi->delete();

        return back()->with('success', 'Prestasi berhasil dihapus.');
    }
}