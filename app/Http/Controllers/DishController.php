<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Components;


class DishController extends Controller
{ 
	public function index() {
		$dish = Dish::all();
		$dish_interim = Dish::where('interim', true)->get();
		$components = Components::all();
		return view('dish.index', [
			'dish' => $dish,
			'components' => $components,
			'dish_interim' => $dish_interim
		]);
	}
	public function store() {
		$components = Components::all();
		$dishes = Dish::where('interim', true)->get();
		return view('dish.store', [
			'components' => $components,
			'dishes' => $dishes
		]);
	}
	public function storepost(Request $request) {

		// Загрузка фотографий
		$imageName = time().'.'.$request->image->extension(); 
		$request->file('image')->move(public_path() . '/uploads',$imageName);
		$path = '/uploads/'.$imageName;
 		
		// Ищем нужные компоненты

		$components = Components::all();
		$comparr = [];
		foreach ($components as  $value) {
			if (isset($_POST['component-'.$value->id])) {
				if($_POST['component-'.$value->id] != '') {
					$comparr[$value->id] = $_POST['component-'.$value->id];
				}
			}
		}

		// Ищем блюда
		$dishes =  Dish::where('interim', true)->get();
		$disharr = [];
		foreach ($dishes as  $value) {
			if (isset($_POST['dish-'.$value->id])) {
				if($_POST['dish-'.$value->id] != '') {
					$disharr[$value->id] = $_POST['dish-'.$value->id];
				}
			}
		}

		if (isset($_POST['interim'])) {
			$interim = true;
		} else {
			$interim = false;
		}
		$dish = new Dish;
		$dish->name = $request->name;
		$dish->price = $request->price;
		$dish->photo = $path;
		$dish->interim = $interim;
		$dish->dishes = serialize($disharr);
		$dish->components = serialize($comparr);
		$dish->save();
		return redirect()->route('dishindex');
	}
	public function update(Request $request) {
		$components = Components::all();
		$dish = Dish::where('id', $request->id)->first();
		$dishes = Dish::where('interim', true)->get();
		return view('dish.update', [
			'dish' => $dish,
			'components' => $components,
			'dishes' => $dishes
		]);
	} 
	public function updatepost(Request $request) {
		if (isset($_POST['interim'])) {
			$interim = true;
		} else {
			$interim = false;
		}
		$dish = Dish::where('id', $request->id)->first();
		if ($request->file('image') != null) {
			// Загрузка фотографий
			$imageName = time().'.'.$request->image->extension(); 
			$request->file('image')->move(public_path() . '/uploads',$imageName);
			$path = '/uploads/'.$imageName;
		} else {
			$path = $dish->photo;
		}
		// Ищем нужные компоненты

		$components = Components::all();
		$comparr = [];
		foreach ($components as  $value) {
			if (isset($_POST['component-'.$value->id])) {
				if($_POST['component-'.$value->id] != '') {
					$comparr[$value->id] = $_POST['component-'.$value->id];
				}
			}
		}

		// Ищем блюда
		$dishes =  Dish::where('interim', true)->get();
		$disharr = [];
		foreach ($dishes as  $value) {
			if (isset($_POST['dish-'.$value->id])) {
				if($_POST['dish-'.$value->id] != '') {
					$disharr[$value->id] = $_POST['dish-'.$value->id];
				}
			}
		}

		Dish::where('id', $request->id)->update([
			'name' => $request->name,
			'photo' => $path,
			'components' => serialize($comparr),
			'dishes' => serialize($disharr),
			'price' => $request->price,
			'interim' => $interim
		]);
		return redirect()->route('dishindex');

	}
	public function delete(Request $request) {
    	Dish::where('id', $request->id)->delete();
    	return redirect()->back();
    }
}
