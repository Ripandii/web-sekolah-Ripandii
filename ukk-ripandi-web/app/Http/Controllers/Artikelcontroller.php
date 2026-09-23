<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    use HandlesUploads;

    public function store(Request $request)
    {
        $data = $this->handleUploads($request, 'artikel');

        Artikel::create($data);

        return back()->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function update(Request $request, Artikel $artikel)
    {
        $data = $this->handleUploads($request, 'artikel');

        $artikel->fill($data);
        $artikel->save();

        return back()->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }
}