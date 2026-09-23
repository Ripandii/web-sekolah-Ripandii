<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    use HandlesUploads;

    public function store(Request $request)
    {
        $data = $this->handleUploads($request, 'jurusan');

        Jurusan::create($data);

        return back()->with('success', 'Jurusan berhasil ditambahkan.');
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $data = $this->handleUploads($request, 'jurusan');

        $jurusan->fill($data);
        $jurusan->save();

        return back()->with('success', 'Jurusan berhasil diperbarui.');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();

        return back()->with('success', 'Jurusan berhasil dihapus.');
    }
}