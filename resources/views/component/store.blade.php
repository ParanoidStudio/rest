<!DOCTYPE html>
<html>
<head>
	<title>Добавить продукт</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<meta charset="utf-8">
</head>
<body>
	    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('components')}}">Продукты (Склад)</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{route('dishindex')}}">Блюда (тех.карта)</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="{{route('orderlist')}}">Таблица заказов</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link " href="{{route('inventarindex')}}">Инвентаризация</a>
      </li>
       <li class="nav-item active">
        <a class="nav-link " href="{{route('inventarlist')}}">Инвентаризации по датам</a>
      </li>
    </ul>
</nav>
<style type="text/css">
	p {
		margin-bottom: 0;
		margin-top: 20px;
	}
</style>
<form action="{{route('componentstorepost')}}" method="POST" class="form-group" style="margin-left: 15px;">
	@csrf 
	<p>Название</p>
	<input type="text" name="name" placeholder="Название" required="">
	<p>Нетто</p>
	<input type="text" name="netto" placeholder="Нетто" value="0">
	<p>Брутто</p>
	<input type="text" name="bruto" placeholder="Брутто" value="0">
	<p>Кол-во</p>
	<input type="text" name="count" placeholder="Кол-во" required="">
	<p>	<input type="checkbox" name="kolvo">Товар в шт.</p>
	<button type="submit" class="btn btn-success" style="margin-top: 12px;">Отправить</button>
</form>
</body>
</html>