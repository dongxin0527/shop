@extends('layouts.index')
@section('content')
    <!-- wishlist -->
    <div class="wishlist section">
        <div class="container">
            <div class="pages-head">
                <h3>WISHLIST</h3>
            </div>
            <div class="content">
                <div class="cart-1">
                    <div class="row">
                        <div class="col s5">
                            <h5>Image</h5>
                        </div>
                        <div class="col s7">
                            <img src="{{$data->goods_img}}" alt="" style="width:500px;height:500px">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Name</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$data->goods_name}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Stock Status</h5>
                        </div>
                        <div class="col s7">
                            <h5>In Stock</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Price</h5>
                        </div>
                        <div class="col s7">
                            <h5>${{$data->goods_price}}</h5>
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
                    <div class="row">
                        <div class="col 12">
                            @if(!empty(Session::get('userName')))
                            <a class="btn button-default" href="{{url('index/Goods/product_do')}}?id={{$data->goods_id}}">SEND TO CART</a>
                            @else
                            <a class="btn button-default" href="{{url('index/Users/login')}}">SEND TO CART</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wishlist -->8
@endsection