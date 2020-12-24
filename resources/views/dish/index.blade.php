<!DOCTYPE html>
<html>
<head>
	<title>Блюда</title>
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
	<h1>Блюда</h1>
<a href="{{route('dishstore')}}">Добавить новое</a>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Фото</th>
      <th scope="col">Название</th>
      <th scope="col">Цена</th>
      <th scope="col">Техкарта</th>
      <th scope="col">Изменить</th>
      <th scope="col">Удалить</th>
    </tr>
  </thead>
  <tbody>
   @foreach($dish as $value)
   <tr>
      <th scope="row">{{$value->id}}</th>
      <td><img width="150" src="{{ asset($value->photo) }}"></td>
      <td>{{$value->name}}</td>
      <td>{{$value->price}} руб.</td>
      <td>
        <?php
        $comp = unserialize($value->components);
        foreach ($components as $component_all) {
          foreach($comp as $key => $component) {
            if ($component_all->id == $key) {
              echo( $component_all->name);
              echo('  :  ');
              echo($component);
              echo('<br>');
            }
          }
        }
        if (!empty($value->dishes)) {
          $disharr = unserialize($value->dishes);
           foreach ($dish_interim as $dish_all) {
          foreach($disharr as $key => $di) {
            if ($dish_all->id == $key) {
              echo( $dish_all->name);
              echo('  :  ');
              echo($di);
              echo('<br>');
            }
          }
        }
        }

        ?>
      </td>
      <td><a href="{{route('dishupdate', $value->id)}}" style="color: green">Изменить</a></td>
      <td><a href="{{route('dishdelete', $value->id)}}" style="color: red">Удалить</a></td>
    </tr>
   @endforeach
  </tbody>
</table>

</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>