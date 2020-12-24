<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components;
use App\Inventar;
use App\InventarList;


class InventarController extends Controller
{
    public function index() {
    	$components = Components::all();
    	return view('inventar.index', [
    		'components' => $components
    	]);
    }
    public function store() {
    	$components = Components::all();
    	$inventar = new Inventar;
    	$inventar->save();
    	$id = $inventar->id;
    	foreach ($components as $value) {
    		$inventarlist = new InventarList;
    		$inventarlist->inventar_id = $id;
    		$inventarlist->name = $_POST['name-'.$value->id];
    		$inventarlist->netto = $_POST['netto-'.$value->id];
    		$inventarlist->bruto = $_POST['bruto-'.$value->id];
    		$inventarlist->count = $_POST['count-'.$value->id];
    		$inventarlist->countreal = $_POST['countreal-'.$value->id];
    		$inventarlist->save();
    	}
    	return redirect()->route('inventarlist');
    }
    public function list() {
    	$inventar = Inventar::orderBy('id', 'desc')->get();
    	return view('inventar.list', [
    		'inventar' => $inventar
    	]);
    }
    public function single(Request $request) {
    	$id = $request->id;
    	$inventar = Inventarlist::where('inventar_id', $id)->get();
    	return view('inventar.single', [
    		'inventar' => $inventar
    	]);
    }
}
