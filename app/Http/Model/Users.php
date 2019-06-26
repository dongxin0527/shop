<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = "users";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $connection = "mysql1";
}