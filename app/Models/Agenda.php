<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    /**
     * Sesuaikan nama tabel ini kalau migrasimu memberi nama berbeda
     * (mis. 'agendas' kalau memakai konvensi plural default).
     */
    protected $table = 'agenda';

    protected $guarded = ['id'];
}