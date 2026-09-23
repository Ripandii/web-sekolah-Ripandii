<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    /**
     * Sesuaikan nama tabel ini kalau migrasimu memberi nama berbeda.
     */
    protected $table = 'fasilitas';

    protected $guarded = ['id'];
}