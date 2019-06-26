<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('index/Users/register_do')}}" method="post">
		<table border="1" align="center">
			@csrf
			<tr>
				<td>
					账号<input type="text" name="user">
				</td>
			</tr>
			<tr>
				<td>
					密码<input type="password" name="pwd">
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" value="注册">
				</td>
			</tr>
		</table>
	</form>
</body>
</html> -->
@extends('layouts.index')
@section('content')
	<!-- register -->
	<div class="pages section">
		<div class="container">
			<div class="pages-head">
				<h3>REGISTER</h3>
			</div>
			<div class="register">
				<div class="row">
					<form class="col s12" action="{{url('index/Users/register_do')}}" method="post">
						@csrf
						<div class="input-field">
							<input type="text" name="user" class="validate" placeholder="NAME" required>
						</div>
						<div class="input-field">
							<input type="password" name="pwd" placeholder="PASSWORD" class="validate" required>
						</div>
						<button class="btn button-default">REGISTER</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end register -->
@endsection