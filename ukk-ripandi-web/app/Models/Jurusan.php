<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    /**
     * Nama tabel sudah sesuai konvensi Laravel (plural), jadi tidak perlu
     * di-set manual. Kolom tabel ini: id, kode, nama_jurusan,
     * kepala_jurusan, foto_kepala_jurusan, logo_jurusan, foto,
     * deskripsi, created_at, updated_at.
     */
    protected $guarded = ['id'];

    /**
     * Satu jurusan punya banyak guru.
     */
    public function guru()
    {
        return $this->hasMany(Guru::class, 'jurusan_id');
    }
}