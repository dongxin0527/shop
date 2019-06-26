@extends('layouts.admin')
@section('content')
	<h2 align="center"><a href="{{url('Users/delsession')}}">退出登录</a></h2>
	
	@if(!empty(session('userInfo')))
	欢迎 {{Session::get('userInfo')}} 登录-
	@else
	<a href="{{url('Users/login')}}">登录</a> / <a href="{{Users/register}}">注册</a>
	@endif
	<table border="1" align="center">
		<tr>
			<td>用户名</td>
			<td>密码</td>
		</tr>
		@foreach($info as $v)
		<tr>
			<td>{{$v->user}}</td>
			<td>{{$v->pwd}}</td>
		</tr>
		@endforeach
	</table>
@endsection