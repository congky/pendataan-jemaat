<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnggotaMenikah extends Model
{
    protected $primaryKey = "usul_anggota_menikah_id";
    public $table = "t_anggota_menikah";
    public $timestamps = false;
}
