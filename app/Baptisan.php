<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baptisan extends Model
{
	protected $primaryKey = "no_baptis";
    public $incrementing = false;
	public $table = "t_baptisan";
	public $timestamps = false;
}
