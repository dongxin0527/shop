@extends('layouts.admin')
@section('content')
	<form action="{{url('admin/Users/register_do')}}" method="post">
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
@endsection