<!DOCTYPE html>
<html>
<body>
@foreach($name as $k=>$v)
<p>{{ucfirst($k)}} = {{$v}}</p>
@endforeach
</body>
</html> 