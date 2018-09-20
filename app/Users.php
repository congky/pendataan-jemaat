<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $primaryKey = "user_id";
    public $table = "t_user";
    public $timestamps = false;
}
