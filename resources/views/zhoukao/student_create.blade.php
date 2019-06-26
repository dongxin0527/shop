<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form action="{{url('stu/save')}}" method="post">
		@csrf
		<table border="1">
			<tr>
				<td>姓名</td>
				<td><input type="text" name="stu_name"></td>
			</tr>
			<tr>
				<td>年龄</td>
				<td><input type="text" name="stu_age"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" value="添加"></td>
			</tr>
		</table>
	</form>
</body>
</html>