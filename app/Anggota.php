<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
	protected $primaryKey = "no_anggota";
	public $table = "t_anggota";
	public $timestamps = false;
}
