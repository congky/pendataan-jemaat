<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
	protected $primaryKey = "anggota_id";
	public $table = "t_anggota";
	public $timestamps = false;
}
