<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kematian extends Model
{
    protected $primaryKey = "kematian_id";
    public $table = "t_kematian";
    public $timestamps = false;
}
