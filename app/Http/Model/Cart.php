<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $primaryKey = "cart_id";
    public $timestamps = false;
    protected $connection = "mysql1";
}
