<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    protected $primaryKey = "anggota_kematian_id";
    public $table = "t_kematian";
    public $timestamps = false;
}
