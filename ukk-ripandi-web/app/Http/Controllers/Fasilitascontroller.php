<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    use HandlesUploads;

    public function store(Request $request)
    {
        $data = $this->handleUploads($request, 'fasilitas');

        Fasilitas::create($data);

        return back()->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function update(Request $request, Fasilitas $fasilitas)
    {
        $data = $this->handleUploads($request, 'fasilitas');

        $fasilitas->fill($data);
        $fasilitas->save();

        return back()->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas)
    {
        $fasilitas->delete();

        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }
}