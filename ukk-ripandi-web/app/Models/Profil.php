<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    /**
     * Tabel data tunggal (cuma 1 baris) untuk profil sekolah.
     * Sesuaikan nama tabel di sini kalau migrasimu memberi nama lain.
     */
    protected $table = 'profil';

    protected $guarded = ['id'];
}