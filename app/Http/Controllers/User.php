<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class User extends Controller
{
    public function index()
    {
    	echo 111;
    	return view('welcome');
    }
}
