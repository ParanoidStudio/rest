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
  .hide-input, .hide-input-dish {
    display: none;
  }
  .wrap {
    display: flex;
    padding-top: 50px;
    flex-direction: column;
  }
  .dishform {
    display: flex;
    width: 250px;
    flex-direction: column;
  }
  .form-item {
    margin-top: 25px;
  }
  .delete {
    cursor: pointer;
  }
  .hide-input, .hide-input-dish {
    margin-bottom: 15px;
  }
</style>
<div class="wrap">
<h1>Добавить блюдо</h1>
<form action="{{route('dishupdatepost')}}" class="dishform" method="POST" enctype="multipart/form-data"   >
  @csrf
  <div class="form-item">
   <input type="text" name="name" placeholder="Название" value="{{$dish->name}}" required="">
  </div>
   <div class="form-item">
   <input type="number" name="price" placeholder="Цена в рублях" value="{{$dish->price}}" required="">
  </div>
 <img style="margin-top: 25px;"   width="150" src="{{ asset($dish->photo) }}">
  <input type="hidden" name="id" value="{{$dish->id}}">
  <div class="form-item">
  <input type="file" name="image">
   </div>
  <div class="form-item">
  <select class="select-component"  >
  <?php
  $comp = unserialize($dish->components);
  $disharr = unserialize($dish->dishes);
  ?>
  @foreach($components as $value)
     <option value="{{$value->id}}">{{$value->name}}</option>
  @endforeach

  </select>
  </div>
  <div class="form-item">
  @foreach($components as $value)
      <?php
      $price = '';
      ?>
        <div class="hide-input"  
         <?php
        foreach ($comp as $key => $val) {
          if ($value->id == $key) {
          $price = $val;
          ?>
          style="display: block"
          <?php
          }
         }
        ?>
         data-id="{{$value->id}}" >
            <p>{{$value->name}} </p>
            <input  name="component-{{$value->id}}" placeholder="грамм" value="{{$price}}">
            <a class="delete" data-id="{{$value->id}}"  style="color: red"  > Удалить</a>
        </div>

  @endforeach
  <h3 style="margin: 0; padding: 0; margin-top: 25px;">Блюда</h3>
  <div class="form-item">
  <select class="select-dish" >
  <option value="">Не выбрано</option>
  @foreach($dishes as $value)
     <option value="{{$value->id}}">{{$value->name}}</option>
  @endforeach
  </select>
  </div>
  <div class="form-item">
  @foreach($dishes as $value)
        <?php
      $price = '';
      ?>
     <div class="hide-input-dish" <?php
        foreach ($disharr as $key => $val) {
          if ($value->id == $key) {
          $price = $val;
          ?>
          style="display: block"
          <?php
          }
         }
        ?> data-id="{{$value->id}}" >
        <p>{{$value->name}} </p>
        <input  name="dish-{{$value->id}}" placeholder="грамм"  value="{{$price}}">
        <a class="delete" data-id="{{$value->id}}"  style="color: red"  > Удалить</a>
     </div>
  @endforeach
</div>
        <p> <input type="checkbox" name="interim" <?php if($dish->interim) {
            echo "checked";
        }?>> Промежуточные блюдо </p>
  <button type="submit">Отправить</button>      
</form>
</div>
<script type="text/javascript"> 
  $(document).ready(function() {
     $('.select-component').on('change', function() {
        var id = $(this).val();
        $('.hide-input[data-id="' + id + '"]').show();
     })
     $('.select-dish').on('change', function() {
        var id = $(this).val();
        $('.hide-input-dish[data-id="' + id + '"]').show();
     })
     $('.delete').on('click', function() {
       var parent = $(this).parent();
       parent.find('input').val("");
       parent.hide();
     });
  });
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html> 