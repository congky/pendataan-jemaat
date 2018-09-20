<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baptisan extends Model
{
	protected $primaryKey = "anggota_baptis_id";
	public $table = "t_baptisan";
	public $timestamps = false;
}
