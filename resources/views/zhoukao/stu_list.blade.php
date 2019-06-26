<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<form>
		<input type="text" name="stu_name">
		<input type="submit" value="搜索">
	</form>
	<table border="1">
		<tr>
			<td>姓名</td>
			<td>年龄</td>
			<td>操作</td>
		</tr>
		@foreach($data as $v)
		<tr>
			<td>{{$v->stu_name}}</td>
			<td>{{$v->stu_age}}</td>
			<td>
				<a href="{{url('stu/upd')}}?stu_id={{$v->stu_id}}">修改</a>
				<a href="{{url('stu/del')}}?stu_id={{$v->stu_id}}">删除</a>
			</td>
		</tr>
		@endforeach
	</table>
		{{$data->appends(['stu_name'=>$stu_name])->links()}}
</body>
</html>