<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Model\Goods as G;

class Goods extends Controller
{
    public function goods_add()
    {
    	return view('goods/goods_add');
    }

    public function goods_add_do(Request $request)
    {
    	$data = $request->post();
        $path = $request->file('goods_img')->store('goods');
        $path = asset('storage/'.$path);
        $G = new G;
        $res = $G->insert(['goods_name'=>$data['goods_name'],'goods_price'=>$data['goods_price'],'goods_img'=>$path,'goods_num'=>$data['goods_num'],'create_time'=>time()]);
        if(!empty($res)){
            return redirect('admin/Goods/goods_index');
        }
    }

    public function goods_index(Request $request)
    {
        $name = $request->all();
        $redis = new \Redis;
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        echo "访问次数:".$redis->get('num');
        if(!isset($name['goods_name'])){
            $name['goods_name'] = "";
            $info = G::orderBy('create_time','desc')->paginate(2);
        }else{
            $info = G::where('goods_name','like',"%".$name['goods_name']."%")->orderBy('create_time','desc')->paginate(2);
        }
        
        return view('goods/goods_index',['info'=>$info,'goods_name'=>$name['goods_name']]);
    }

    public function goods_del(Request $request)
    {
        $id = $request->input('id');
        $G = new G;
        $res = $G->destroy($id);
        if(!empty($res)){
            return redirect('admin/Goods/goods_index');
        }
    }

    public function goods_upd(Request $request)
    {
        $id = $request->input('id');
        $info = G::find($id);
        return view('goods/goods_upd',['info'=>$info]);
    }

    public function goods_upd_do(Request $request)
    {
        $data = $request->post();
        if(!empty($request->file('goods_img'))){
            $path = $request->file('goods_img')->store('goods');
            $path = asset('storage/'.$path);
            $G = new G;
            $res = $G->where(['id'=>$data['id']])->update(['goods_name'=>$data['goods_name'],'goods_price'=>$data['goods_price'],'goods_img'=>$path,'goods_num'=>$data['goods_num']]);
            // echo 1;
            if(!empty($res)){
                return redirect('admin/Goods/goods_index');
            }
        }else{
            $G = new G;
            $res = $G->where(['id'=>$data['id']])->update(['goods_name'=>$data['goods_name'],'goods_price'=>$data['goods_price'],'goods_num'=>$data['goods_num']]);
            // echo 2;
            if(!empty($res)){
                return redirect('admin/Goods/goods_index');
            }else{
            	echo "信息无变化";
            }
        }
    }
}
