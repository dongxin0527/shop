@extends('layouts.admin')
@section('content')
	<form action="{{url('admin/Users/login_do')}}" method="post">
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
@endsection