@extends('layouts.admin')
	@section('content')
	<h1><a href="{{url('admin/Users/delsession')}}">退出登录</a></h1>
	<form>
		<input type="text" name="goods_name" value="{{$goods_name}}">
		<input type="submit" value="搜索">
	</form>
	<table border="1">
		<tr>
			<th>商品名称</th>
			<th>商品价格</th>
			<th>商品图片</th>
			<th>商品库存</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
		@foreach($info as $v)
		<tr>
			<td>{{$v->goods_name}}</td>
			<td>{{$v->goods_price}}</td>
			<td><img src="{{$v->goods_img}}" width="50"></td>
			<td>{{$v->goods_num}}</td>
			<td>{{date('Y-m-d H:i:s',$v->create_time)}}</td>
			<td>
				<a href="{{url('admin/Goods/goods_del')}}?id={{$v->id}}">删除</a>
				<a href="{{url('admin/Goods/goods_upd')}}?id={{$v->id}}">修改</a>
			</td>
		</tr>
		@endforeach
	</table>
	{{$info->appends(['goods_name'=>$goods_name])->links()}}
	@endsection