<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class Users extends Controller
{
    public function register()
    {
    	return view('goods/user_register');
    }

    public function register_do(Request $request)
    {
    	$data = $request->post();
    	$res = DB::table('users')->insert([
    		'user'=>$data['user'],
    		'pwd'=>md5($data['pwd'])
    	]);
    	if(!empty($res)){
    		return redirect('admin/Users/login');
    	}
    }

    public function login()
    {
    	return view('goods/user_login');
    }

    public function login_do(Request $request)
    {
    	$data = $request->post();
    	$user_info = DB::table('users')->where('user','=',$data['user'])->where('pwd','=',md5($data['pwd']))->first();
    	if(!empty($user_info)){
    		session(['userInfo'=>$data['user']]);
    		return redirect('admin/Goods/goods_index');
    	}else{
    		return redirect('admin/Goods/goods_index');
    	}
    }

    public function delsession(Request $request)
    {
    	$request->session()->forget('userInfo');
    	return redirect('admin/Users/login');
    }
}
