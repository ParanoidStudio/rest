<!DOCTYPE html>
<html>
<head>
	<title>Добавить</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

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
      <li class="nav-item active">
        <a class="nav-link " href="{{route('worker')}}">Сотрудник</a>
      </li>
    </ul>
</nav>
	<form action="{{route('componentaddpost')}}" method="POST">
		@csrf
    @if($component->kolvo)
    <p>Количество</p>
    
    <input type="number" name="count" placeholder="Кол-во">
    @else
    <p>Брутто</p>
    <input type="number" name="bruto" placeholder="Брутто">
    <p>Нетто</p>
    <input type="number" name="netto" placeholder="Нетто">
    @endif
		<input type="hidden" name="id" value="{{$id}}">
		<button>Добавить</button>
	</form>
</body>
</html>