<!DOCTYPE html>
<html>
<head>
  <title>Продукты</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
    input {
      max-width: 130px;
    }
  </style>
<div class="wrap">
  <h1>Инвентаризация</h1>
    <form action="{{route('inventarstore')}}" method="POST">
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Название</th>
      <th scope="col">Нетто</th>
      <th scope="col">Брутто</th>
      <th scope="col">Количество</th>
      <th scope="col">Количество фактическое</th>
      <th scope="col">Результат</th>
    </tr>
  </thead>
  <tbody>
      @csrf
   @foreach($inventar as $value)
   <tr>
      <th scope="row">{{$value->id}}</th>
      <td><input type="" name="name-{{$value->id}}" value="{{$value->name}}" readonly=""></td>
      <td><input type="" name="netto-{{$value->id}}" value="{{$value->netto}}" readonly=""></td>
      <td><input type="" name="bruto-{{$value->id}}" value="{{$value->bruto}}" readonly=""></td>
      <td><input class="count" type="" name="count-{{$value->id}}" value="{{$value->count}} " readonly=""></td>
      <td><input class="countreal" type="number" name="countreal-{{$value->id}}" value="{{$value->countreal}}" readonly="true"></td>
      <td><input class="result" readonly="true" type="number" value="<?php echo $value->count - $value->countreal?>"></td>
    </tr>
   @endforeach

  </tbody>
</table>
    </form>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>