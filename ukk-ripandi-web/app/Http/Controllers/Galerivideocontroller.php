<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\GaleriVideo;
use Illuminate\Http\Request;

class GaleriVideoController extends Controller
{
    use HandlesUploads;

    public function store(Request $request)
    {
        // Kemungkinan besar isinya link video (YouTube dll), bukan file,
        // tapi handleUploads tetap aman dipakai kalau suatu saat ada
        // field thumbnail berupa file gambar.
        $data = $this->handleUploads($request, 'galeri-video');

        GaleriVideo::create($data);

        return back()->with('success', 'Galeri video berhasil ditambahkan.');
    }

    public function update(Request $request, GaleriVideo $galeri_video)
    {
        $data = $this->handleUploads($request, 'galeri-video');

        $galeri_video->fill($data);
        $galeri_video->save();

        return back()->with('success', 'Galeri video berhasil diperbarui.');
    }

    public function destroy(GaleriVideo $galeri_video)
    {
        $galeri_video->delete();

        return back()->with('success', 'Galeri video berhasil dihapus.');
    }
}