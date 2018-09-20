<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PenyerahanAnak extends Model
{
    protected $primaryKey = "penyerahan_anak_id";
    public $table = "t_penyerahan_anak";
    public $timestamps = false;
}
