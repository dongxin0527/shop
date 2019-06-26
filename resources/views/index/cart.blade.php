@extends('layouts.index')
	@section('content')
	<!-- cart -->
	<div class="cart section">
		<div class="container">
			<div class="pages-head">
				<h3>CART</h3>
			</div>
			<div class="content">
				@foreach($cart as $v)
				<div class="cart-1">
					<div class="row">
						<div class="col s5">
							<h5>Image</h5>
						</div>
						<div class="col s7">
							<img src='{{asset("$v->goods_img")}}' alt="" style="width: 200px;height: 200px;">
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Name</h5>
						</div>
						<div class="col s7">
							<h5><a href="">{{$v->goods_name}}</a></h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Quantity</h5>
						</div>
						<div class="col s7">
							<input value="{{$v->goods_nums}}" type="text">
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Price</h5>
						</div>
						<div class="col s7">
							<h5>${{$v->goods_price}}</h5>
						</div>
					</div>
					<div class="row">
						<div class="col s5">
							<h5>Action</h5>
						</div>
						<div class="col s7">
							<h5><i class="fa fa-trash"></i></h5>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="total">
				<div class="row">
					<div class="col s7">
						<h6>Total</h6>
					</div>
					<div class="col s5">
						<h6>${{$total}}</h6>
					</div>
				</div>
			</div>
			<a class="btn button-default" href="{{url('index/Goods/order_create')}}?total={{$total}}">Process to Checkout</a>
		</div>
	</div>
	<!-- end cart -->
	@endsection 