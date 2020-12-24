<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Продукты
// Auth::routes();

Route::group(['middleware' => 'auth'], function () {
	Route::group(['middleware' => 'isadmin'], function () {
		Route::get('component/index', 'ComponentsController@index')->name('components');
		Route::get('component/store', 'ComponentsController@store')->name('componentstore');
		Route::post('component/storepost', 'ComponentsController@storepost')->name('componentstorepost');

		Route::get('component/componentupdate/{id}', 'ComponentsController@componentupdate')->name('componentupdate');
		Route::post('component/componentupdatepost', 'ComponentsController@componentupdatepost')->name('componentupdatepost');
		Route::get('component/componentadd/{id}', 'ComponentsController@componentadd')->name('componentadd');
		Route::post('component/componentaddpost', 'ComponentsController@componentaddpost')->name('componentaddpost');
		Route::get('component/componentdelete/{id}', 'ComponentsController@componentdelete')->name('componentdelete');
		Route::get('dish/store', 'DishController@store')->name('dishstore');
		Route::get('dish/index', 'DishController@index')->name('dishindex');
		Route::get('dish/update/{id}', 'DishController@update')->name('dishupdate');
		Route::get('dish/delete/{id}', 'DishController@delete')->name('dishdelete');
		Route::post('dish/updatepost', 'DishController@updatepost')->name('dishupdatepost');
		Route::post('dish/storepost', 'DishController@storepost')->name('dishstorepost');
		Route::get('order/list', 'OrderController@list')->name('orderlist');
		Route::get('order/delete/{id}', 'OrderController@delete')->name('orderdelete');
		Route::get('inventar/list', 'InventarController@list')->name('inventarlist');
		Route::get('inventar/single/{id}', 'InventarController@single')->name('inventarsingle');
		Route::get('inventar/index', 'InventarController@index')->name('inventarindex');
		Route::post('inventar/store', 'InventarController@store')->name('inventarstore');
		Route::get('/home', 'HomeController@index')->name('home');
		Route::post('/workers/store', 'WorkersController@store')->name('workersadd');
		Route::get('/workers/index', 'WorkersController@index')->name('worker');
		Route::get('/workers/delete/{id}', 'WorkersController@delete')->name('workerdelete');
	});
	Route::get('/', 'OrderController@index')->name('orderindex');
	Route::post('order/store', 'OrderController@store')->name('orderpost');

});
Auth::routes();
// Route::get('/register', function() {
// 	return redirect('/login');
// });
Route::get('/home', 'HomeController@index')->name('home');
