@extends('layouts.admin')
	@section('content')
	<form action="{{url('admin/Goods/goods_add_do')}}" method="post" enctype="multipart/form-data">
		@csrf
		商品名称 <input type="text" name="goods_name"><p>
		商品图片 <input type="file" name="goods_img"><p>
		商品库存 <input type="text" name="goods_num"><p>
		商品价格 <input type="text" name="goods_price"><p>
		<input type="submit" value="添加">
	</form>
	@endsection