<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    /**
     * Sesuaikan nama tabel ini kalau migrasimu memberi nama berbeda
     * (mis. 'artikels' kalau memakai konvensi plural default).
     */
    protected $table = 'artikel';

    protected $guarded = ['id'];
}