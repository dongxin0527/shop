<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('index/Users/login_do')}}" method="post">
		@csrf
		<table align="center" border="1">
			<tr>
				<td>
					账号 <input type="text" name="user">
				</td>
			</tr>
			<tr>
				<td>
					密码 <input type="password" name="pwd">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="登录">
				</td>
			</tr>
		</table>
	</form>
</body>
</html> -->
@extends('layouts.index')
@section('content')
	<!-- login -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>LOGIN</h3>
			</div>
			<div class="login">
				<div class="row">
					<form class="col s12" action="{{url('index/Users/login_do')}}" method="post">
						@csrf
						<div class="input-field">
							<input type="text" class="validate" name="user" placeholder="USERNAME" required>
						</div>
						<div class="input-field">
							<input type="password" class="validate" name="pwd" placeholder="PASSWORD" required>
						</div>
						<a href=""><h6>Forgot Password ?</h6></a>
						<button href="" class="btn button-default">LOGIN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end login -->
	
	<!-- loader -->
	<div id="fakeLoader"></div>
	<!-- end loader -->
	@endsection