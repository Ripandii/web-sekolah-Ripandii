<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesUploads;
use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    use HandlesUploads;

    public function store(Request $request)
    {
        $data = $this->handleUploads($request, 'guru-guru');

        // Checkbox HTML tidak terkirim sama sekali kalau tidak dicentang,
        // jadi perlu dipaksa jadi boolean eksplisit.
        $data['staf'] = $request->boolean('staf');

        Guru::create($data);

        return back()->with('success', 'Guru/staf berhasil ditambahkan.');
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $this->handleUploads($request, 'guru-guru');
        $data['staf'] = $request->boolean('staf');

        $guru->fill($data);
        $guru->save();

        return back()->with('success', 'Guru/staf berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();

        return back()->with('success', 'Guru/staf berhasil dihapus.');
    }
}