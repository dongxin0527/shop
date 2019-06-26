<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', "User@index");

// 后台
// -------------------------------------------------------------------------------------------------------
//用户注册登录
Route::get('admin/Users/register','admin\Users@register');
Route::post('admin/Users/register_do','admin\Users@register_do');
Route::get('admin/Users/login','admin\Users@login');
Route::post('admin/Users/login_do','admin\Users@login_do');
Route::get('admin/Users/delsession','admin\Users@delsession');
//中间件防止非法登录
Route::middleware('Users')->group(function () {
    //商品增删改查
	Route::get('admin/Goods/goods_add','admin\Goods@goods_add');
	Route::post('admin/Goods/goods_add_do','admin\Goods@goods_add_do');
	Route::get('admin/Goods/goods_del','admin\Goods@goods_del');
	Route::get('admin/Goods/goods_index','admin\Goods@goods_index');
	//下班不可修改
	Route::middleware('GG')->group(function () {
	    Route::get('admin/Goods/goods_upd','admin\Goods@goods_upd');
		Route::post('admin/Goods/goods_upd_do','admin\Goods@goods_upd_do');
	});
});
//---------------------------------------------------------------------------------------------------------
//前台
//登录注册
Route::get('index/Users/register','index\Goods@register');
Route::post('index/Users/register_do','index\Goods@register_do');
Route::get('index/Users/login','index\Goods@login');
Route::post('index/Users/login_do','index\Goods@login_do');
//前台首页
Route::get('/','index\Goods@index');
//商品详情页
Route::get('index/Goods/product','index\Goods@product');
Route::get('index/Goods/product_do','index\Goods@product_do');
//购物车
Route::get('index/Goods/cart','index\Goods@cart');
//添加订单
Route::get('index/Goods/order_create','index\Goods@order_create');
//删除订单
Route::get('index/Goods/order_del','index\Goods@order_del');
//订单列表
Route::get('index/Goods/order','index\Goods@order');
//修改订单状态为已过期
Route::post('index/Goods/order_status','index\Goods@order_status');

//同步支付
Route::get('index/AliPayController/pay','Pay\AliPayController@pay');
//同步地址
Route::get('return_url','Pay\AliPayController@aliReturn');

//异步地址
Route::post('notify_url','Pay\AliPayController@aliNotify');







//周考学生增删改查搜索分页
Route::get('stu/create','zhoukao\Student@create');
Route::post('stu/save','zhoukao\Student@save');
Route::get('stu/list','zhoukao\Student@list');
Route::get('stu/upd','zhoukao\Student@upd');
Route::get('stu/del','zhoukao\Student@del');
Route::post('stu/upd_do','zhoukao\Student@upd_do');






