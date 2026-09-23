<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    /**
     * Kata "guru" sama untuk tunggal/jamak dalam Bahasa Indonesia, jadi
     * nama tabel di-set manual supaya tidak salah ditebak jadi "gurus"
     * oleh Eloquent. Sesuaikan kalau nama tabel migrasimu berbeda.
     */
    protected $table = 'guru';

    protected $guarded = ['id'];

    protected $casts = [
        'staf' => 'boolean',
    ];

    /**
     * Setiap guru/staf terkait ke satu jurusan (boleh null untuk guru
     * mapel umum/staf yang tidak terikat jurusan tertentu).
     */
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}