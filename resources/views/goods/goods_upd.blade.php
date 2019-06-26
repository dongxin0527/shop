@extends('layouts.admin')
	@section('content')
	<form action="{{url('admin/Goods/goods_upd_do')}}" method="post" enctype="multipart/form-data">
		@csrf
		商品名称 <input type="text" name="goods_name" value="{{$info->goods_name}}"><p>
		商品图片 <input type="file" name="goods_img"><p>
		商品库存 <input type="text" name="goods_num" value="{{$info->goods_num}}"><p>
		商品价格 <input type="text" name="goods_price" value="{{$info->goods_price}}"><p>
				<input type="hidden" name="id" value="{{$info->id}}">
		<input type="submit" value="修改">
	</form>
	@endsection
