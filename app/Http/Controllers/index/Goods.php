<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Users;
use App\Http\Model\Goods as G;
use App\Http\Model\Cart;
use App\Http\Model\Order;

class Goods extends Controller
{
    //注册页面
     public function register()
    {
    	return view('index/user_register');
    }
    //注册执行
    public function register_do(Request $request)
    {
    	$data = $request->post();
    	$res = Users::insert([
    		'user'=>$data['user'],
    		'pwd'=>md5($data['pwd'])
    	]);
    	if(!empty($res)){
    		return redirect('index/Users/login');
    	}
    }
    // 登录页面
    public function login()
    {
    	return view('index/user_login');
    }
    // 登陆执行
    public function login_do(Request $request)
    {
    	$data = $request->post();
    	$user_info = Users::where('user','=',$data['user'])->where('pwd','=',md5($data['pwd']))->first();
    	// dd($user_info);
    	if(!empty($user_info)){
    		session(['userName'=>$data['user'],'userId'=>$user_info['user_id']]);
    		return redirect('/');
    	}else{
    		return redirect('index/Users/login');
    	}
    }
    // 前台首页
    public function index()
    {
    	$goods_info = G::limit(4)->get();
    	return view('index/index',['goods_info'=>$goods_info]);
    }
    // 退出
    public function delsession()
    {
    	$request->session()->forget('userInfo');
    	return redirect('admin/Users/login');
    }
    // 商品详情
    public function product(Request $request)
    {
    	$id = $request->input('id');
    	$data = G::find($id);
    	// dd($data);
    	return view('index/product',['data'=>$data]);
    }
    // 添加进购物车
    public function product_do(Request $request)
    {
    	$goods_id = $request->input('id');
    	$goodsInfo = G::find($goods_id)->toArray();
    	$user_id = session('userId');
        $info = Cart::where('user_id','=',$user_id)->where('goods_id','=',$goods_id)->first();
        if(!empty($info)){
            // echo 1;die;
            Cart::where('user_id','=',$user_id)->where('goods_id','=',$goods_id)->update(['goods_nums'=>$info['goods_nums']+1]);
        }else{
            // echo 11;die;
            $data = ['goods_id'=>$goodsInfo['goods_id'],'goods_price'=>$goodsInfo['goods_price'],'add_time'=>time(),'goods_img'=>$goodsInfo['goods_img'],'user_id'=>$user_id,'goods_nums'=>1];
            // dd($data);
            Cart::insert($data);
            // dd($goodsInfo);            
        }
    	return redirect('index/Goods/cart');
    }
    // 购物车列表
    public function cart(Request $request)
    {
    	// $goods_id = $request->input('id');
    	// $goodsInfo = G::find($goods_id)->toArray();
    	$user_id = session('userId');
    	// $data = ['goods_id'=>$goodsInfo['goods_id'],'goods_price'=>$goodsInfo['goods_price'],'add_time'=>time(),'goods_img'=>$goodsInfo['goods_img'],'user_id'=>$user_id];
    	// // dd($data);
    	// Cart::insert($data);
    	$cart = Cart::join('goods','goods.goods_id','=','cart.goods_id')->get();
        $goods_ids = "";
        foreach($cart as $k=>$v){
            $goods_ids .= $v['goods_id'].",";
        }
        // dd($goods_ids);
    	$total = Cart::where('user_id','=',$user_id)->pluck('goods_price')->toArray();
    	// array_sum($total);
    	// dd($total);
    	// dd($cart->toArray());
    	return view('index/cart',['cart'=>$cart,'goods_ids'=>$goods_ids,'total'=>array_sum($total)]);
    }

    // 订单添加
    public function order_create(Request $request)
    {
        $pay_money = $request->input('total');
        $order = time().mt_rand(1000,1111);
        $uid = session('userId');
        $add_time = time();
        $res = Order::insert(['order'=>$order,'uid'=>$uid,'pay_money'=>$pay_money,'state'=>1,'pay_time'=>0,'add_time'=>$add_time]);
        if(!empty($res)){
            return redirect('index/Goods/order');
        }
    }
    // 订单详情页面
    public function order(Request $request)
    {
        $data = Order::get();
        // dd($data);
        return view('index/order',['data'=>$data]);
    }
    // 订单删除
    public function order_del(Request $request)
    {
        $id = $request->input('id');
        $res = Order::where('id','=',$id)->delete();
        if(!empty($res)){
            return redirect('index/Goods/order');
        }
    }

    //修改订单状态为已过期
    public function order_status(Request $request)
    {
        $order_id = $request->post('order_id');
        Order::where('id','=',$order_id)->update(['state'=>3]);
    }

    public function return_url(Request $request)
    {
        $data = $request->all();
        dd($data);
    	echo '支付成功';
    }
}
