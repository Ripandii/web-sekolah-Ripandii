<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    /**
     * Sesuaikan nama tabel ini kalau migrasimu memberi nama berbeda
     * (mis. 'ekstrakurikulers' kalau memakai konvensi plural default).
     */
    protected $table = 'ekstrakurikuler';

    protected $guarded = ['id'];
}