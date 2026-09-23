<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beranda extends Model
{
    /**
     * Tabel data tunggal (cuma 1 baris) untuk konten Beranda/Tentang Kami.
     * Sesuaikan nama tabel di sini kalau migrasimu memberi nama lain.
     */
    protected $table = 'beranda';

    protected $guarded = ['id'];
}