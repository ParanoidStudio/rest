<!DOCTYPE html>
<html>
<head>
	<title>Продукты</title>
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
    </ul>
</nav>
<div class="wrap">
	<h1>Продукты</h1>
<a href="{{route('componentstore')}}">Добавить новый</a>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Название</th>
      <th scope="col">Брутто</th>
      <th scope="col">Нетто</th>
      <th scope="col">Количество</th>
      <th scope="col">Добавить</th>
      <th scope="col">Изменить</th>
      <th scope="col">Удалить</th>
    </tr>
  </thead>
  <tbody>
   @foreach($components as $value)
   <tr>
      <th scope="row">{{$value->id}}</th>
      <td>{{$value->name}}</td>
      <td>{{$value->bruto}}</td>
      <td>{{$value->netto}}</td>
      <td>{{$value->count}}</td>
      <td><a style="color: green" href="{{route('componentadd', $value->id)}}">Добавить</a></td>
      <td><a href="{{route('componentupdate', $value->id)}}">Изменить</a></td>
      <td><a style="color: red" href="{{route('componentdelete', $value->id)}}">Удалить</a></td>
    </tr>
   @endforeach
  </tbody>
</table>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>