<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('stu/upd_do')}}" method="post">
		@csrf
		<table border="1">
			<tr>
				<td>姓名</td>
				<td><input type="text" name="stu_name" value="{{$data->stu_name}}"></td>
			</tr>
			<tr>
				<td>年龄</td>
				<td><input type="text" name="stu_age" value="{{$data->stu_age}}"></td>
			</tr>
			<tr>
				<td></td>
				<input type="hidden" name="stu_id" value="{{$data->stu_id}}">
				<td><input type="submit" value="修改"></td>
			</tr>
		</table>
	</form>
</body>
</html>