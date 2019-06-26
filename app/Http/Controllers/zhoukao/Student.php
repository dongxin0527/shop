<?php

namespace App\Http\Controllers\zhoukao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Student extends Controller
{
    public function create()
    {
    	return view('zhoukao/student_create');
    }

    public function save(Request $request)
    {
    	$data = $request->post();
    	$res = DB::table('student')->insert(['stu_name'=>$data['stu_name'],'stu_age'=>$data['stu_age']]);
    	if(!empty($res)){
    		return redirect('stu/list');
    	}
    }

    public function list(Request $request)
    {
    	$stu_name = $request->input('stu_name');
    	if(isset($stu_name)){
    		$data = DB::table('student')->where('stu_name','like',$stu_name)->paginate(2);
    		return view('zhoukao/stu_list',['data'=>$data,'stu_name'=>$stu_name]);
    	}else{
    		$stu_name = "";
    		$data = DB::table('student')->paginate(2);
    		return view('zhoukao/stu_list',['data'=>$data,'stu_name'=>$stu_name]);
    	}
    }

    public function del(Request $request)
    {
    	$stu_id = $request->input('stu_id');
    	$res = DB::table('student')->where('stu_id','=',$stu_id)->delete();
    	if(!empty($res)){
    		return redirect('stu/list');
    	}
    }

    public function upd(Request $request)
    {
    	$stu_id = $request->input('stu_id');
    	$data = DB::table('student')->where('stu_id','=',$stu_id)->first();
    	return view('zhoukao/stu_upd',['data'=>$data]);
    }

    public function upd_do(Request $request)
    {
    	$data = $request->post();
    	$res = DB::table('student')->where('stu_id','=',$data['stu_id'])->update(['stu_name'=>$data['stu_name'],'stu_age'=>$data['stu_age']]);
    	if(!empty($res)){
    		return redirect('stu/list');
    	}
    }
}
