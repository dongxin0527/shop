@extends('layouts.index')
@section('content')
<!-- checkout -->
<div class="checkout pages section">
	<div class="container">
		<div class="pages-head">
			<h3>CHECKOUT</h3>
		</div>
		<div class="checkout-content">
			<div class="row">
				<div class="col s12">
					<ul class="collapsible" data-collapsible="accordion">
						<li>
							<div class="collapsible-header"><h5>1 - 收货地址</h5></div>
							<div class="collapsible-body">
								<div class="shipping-information">
									<form action="#">
										<div class="input-field">
											<h5>Name*</h5>
											<input type="text" class="validate" required>
										</div>
										<div class="input-field">
											<h5>Email*</h5>
											<input type="email" class="validate" required>
										</div>
										<div class="input-field">
											<h5>Company Name</h5>
											<input type="text" class="validate">
										</div>
										<div class="input-field">
											<h5>Address*</h5>
											<input type="text" class="validate" required>
										</div>
										<div class="input-field">
											<h5>Town/City*</h5>
											<input type="text" class="validate" required>
										</div>
										<div class="input-field">
											<h5>State/Country*</h5>
											<input type="text" class="validate" required>
										</div>
										<div class="input-field">
											<h5>Portalcode/ZIP*</h5>
											<input type="number" class="validate" required>
										</div>
										<div class="input-field">
											<h5>Phone*</h5>
											<input type="number" class="validate" required>
										</div>
										<a href="" class="btn button-default">CONTINUE</a>
									</form>
								</div>
							</div>
						</li>
						<li>
							<div class="collapsible-header"><h5>2 - 支付方式</h5></div>
							<div class="collapsible-body">
								<div class="payment-mode">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consectetur provident repellat</p>
									<form action="#" class="checkout-radio">
											<div class="input-field">
												<input type="radio" class="with-gap" id="bank-transfer" name="group1" checked>
												<label for="bank-transfer"><span>支付宝</span></label>
											</div>
											<div class="input-field">
												<input type="radio" class="with-gap" id="cash-on-delivery" name="group1">
												<label for="cash-on-delivery"><span>Cash on Delivery</span></label>
											</div>
											<div class="input-field">
												<input type="radio" class="with-gap" id="online-payments" name="group1">
												<label for="online-payments"><span>Online Payments</span></label>
											</div>

										<a href="" class="btn button-default">CONTINUE</a>
									</form>
								</div>
							</div>
						</li>
						<li>
							<div class="collapsible-header"><h5>3 - 订单详情</h5></div>
							@foreach($data as $v)
							<div class="collapsible-body">
								<div class="order-review">
									<div class="row">
										<div class="col s12">
											<div class="cart-details">
												<div class="col s5">
													<div class="cart-product">
														<h5>订单编号</h5>
													</div>
												</div>
												<div class="col s7">
													<div class="cart-product">
														<b>{{$v->order}}</b>
													</div>
												</div>
											</div>
											<div class="divider"></div>
											<div class="cart-details">
												<div class="col s5">
													<div class="cart-product">
														<h5>添加时间</h5>
													</div>
												</div>
												<div class="col s7">
													<div class="cart-product">
														<b>{{date('Y-m-d H:i:s',$v->add_time)}}</b>
													</div>
												</div>
											</div>
											<div class="divider"></div>
										</div>
									</div>
								</div>
								<div class="order-review final-price">
									<div class="row">
										<div class="col s12">
											<div class="cart-details">
												<div class="col s8">
													<div class="cart-product">
														<h5>订单状态</h5>
													</div>
												</div>
												<div class="col s4">
													<div class="cart-product">
														<span class="times" order-state="{{$v->state}}" end-time="{{date('Y-m-d H:i:s',$v->add_time+30)}}" order_id="{{$v->id}}"></span>
													</div>
												</div>
											</div>
											<div class="cart-details">
												<div class="col s8">
													<div class="cart-product">
														<h5>应付款</h5>
													</div>
												</div>
												<div class="col s4">
													<div class="cart-product">
														<span>${{$v->pay_money}}</span>
													</div>
												</div>
											</div>
											<div class="cart-details">
												<div class="col s8">
													<div class="cart-product">
														<h5>操作</h5>
													</div>
												</div>
												<div class="col s4">
													<div class="cart-product">
														<span><a href="{{url('index/Goods/order_del')}}?id={{$v->id}}">删除订单</a></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<a href="{{url('index/AliPayController/pay')}}?total={{$v->pay_money}}&oid={{$v->order}}" class="btn button-default button-fullwidth">去付款</a>
								</div>
							</div>
							@endforeach
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end checkout -->
@endsection
<script src="{{asset('/jquery-3.3.1.js')}}"></script>
<script>
	$(function(){
		$.ajaxSetup({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    }
		});




		getTime();
			
		
		function getTime(){
			$(".times").each(function(){
			var _this = $(this);
			var end_time = _this.attr('end-time'); //结束时间
			var state = _this.attr('order-state'); //订单状态
			
			var endDate = new Date(end_time);


	            endDate = endDate.getTime();//1970-截止时间  从1970年到截止时间有多少毫秒
	 
	            //获取一个现在的时间
	            var nowdate = new Date;
	            nowdate = nowdate.getTime(); //现在时间-截止时间  从现在到截止时间有多少毫秒
	 
	            //获取时间差 把毫秒转换为秒
	            var diff = parseInt((endDate - nowdate) / 1000);


	            if(diff <= 0){
	            	//window.location.reload();
	            	
	            	// _this.parent().parent().parent().parent().css('display','none');
	            	// _this.css('display','none');
	            	// _this.removeClass('times');

	            	_this.parent().parent().parent().parent().parents().next().remove();
	            	_this.parent().html('已过期');
	            	if(state == 1){
	            		var order_id = _this.attr('order_id');
		            	$.ajax({
		            		url:"{{url('index/Goods/order_status')}}",
		            		method:"post",
		            		data:{order_id:order_id},
		            		async:true,
		            		success:function(msg){
		            			
		            		}
		            	});
	            	}
	            }
	 
	            h = parseInt(diff / 3600);//获取还有小时
	            m = parseInt(diff / 60 % 60);//获取还有分钟
	            s = diff % 60;//获取多少秒数
	 
	            //将时分秒转化为双位数
	            h = setNum(h);
	            m = setNum(m);
	            s = setNum(s);
	            //输出时分秒
	            _this.html(m + "分" + s + "秒");
			});
			window.setTimeout(function() {
	    		getTime();
	  		}, 1000);
		}


		
		
		 //window.setTimeout(getTime, 1000);
	        //设置函数 把小于10的数字转换为两位数
	        function setNum(num) {
	            if (num < 10) {
	                num = "0" + num;
	            }
	            return num;
	        }

	        function ajax(order_id){
	        	
	        }
	});		
</script>