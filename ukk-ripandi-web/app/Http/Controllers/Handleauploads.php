<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;

trait HandlesUploads
{
    /**
     * Pindahkan SEMUA file yang diunggah pada request (apa pun nama field-nya)
     * ke public/images/{folder}, lalu kembalikan array data siap simpan
     * (field file diganti isinya jadi nama file, field lain dibiarkan apa
     * adanya). Supaya tidak perlu menebak-nebak nama field file di form.
     */
    protected function handleUploads(Request $request, string $folder): array
    {
        $data = $request->except(['_token', '_method']);

        foreach ($request->allFiles() as $field => $file) {
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("images/{$folder}"), $filename);
            $data[$field] = $filename;
        }

        return $data;
    }
}