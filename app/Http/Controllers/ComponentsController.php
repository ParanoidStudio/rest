<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Components;
class ComponentsController extends Controller
{
    public function index() {
    	$components = Components::all();
    	return view('component.index', [
    		'components' => $components
    	]);
    }
    public function store() {
    	return view('component.store');
    }
    public function storepost(Request $request) {
        if (isset($_POST['kolvo'])) {
            $kolvo = true;
        } else {
            $kolvo = false;
        }
    	$component = new Components;
    	$component->name = $request->name;
    	$component->netto = $request->netto;
    	$component->bruto = $request->bruto;
        $component->count = $request->count;
    	$component->kolvo = $kolvo;
    	$component->save();
    	return redirect()->route('components');
    }
    public function componentdelete(Request $request) {
    	Components::where('id', $request->id)->delete();
    	return redirect()->back();
    }
    public function componentadd(Request $request) {
    	$id = $request->id;
        $component = Components::where('id', $request->id)->first();

    	return view('component.add', [
    		'id' => $id,
            'component' => $component
    	]);
    }
    public function componentaddpost(Request $request) {
    	$component = Components::where('id', $request->id)->first();
        if ($component->kolvo) {
            $count = $component->count + $request->count;
            $component = Components::where('id', $request->id)->update([
                'count' => $count,
            ]);
        } else {
            $count = $component->netto + $request->netto;
            $netto = $component->netto + $request->netto;
            $bruto = $component->bruto + $request->bruto;
            $component = Components::where('id', $request->id)->update([
                'count' => $count,
                'netto' => $netto,
                'bruto' => $bruto
            ]);
        }
    	return redirect()->route('components');
    }
    public function componentupdate(Request $request) {
    	$id = $request->id;
    	$component = Components::where('id', $request->id)->first();
    	return view('component.update', [
    		'id' => $id,
    		'component' => $component
    	]);
    }
    public function componentupdatepost(Request $request) {
        if (isset($_POST['kolvo'])) {
            $kolvo = true;
        } else {
            $kolvo = false;
        }
    	Components::where('id', $request->id)->update([
    		'name' => $request->name,
    		'netto' => $request->netto,
    		'bruto' => $request->bruto,
            'count' => $request->count,
    		'kolvo' => $kolvo,
    	]);
    	return redirect()->route('components');
    }
}
