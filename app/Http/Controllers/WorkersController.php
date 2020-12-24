<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workers;

class WorkersController extends Controller
{
    public function index()
    {
    	$workers = Workers::all();
    	return view('workers.index', [
    		'workers' => $workers
    	]);
    }
    public function store(Request $request) {
    	$workers = new Workers;
    	$workers->name = $request->name;
    	$workers->save();
    	return redirect()->back();
    }
    public function delete(Request $request) {
    	Workers::where('id', $request->id)->delete();
    	return redirect()->back();
    }
}
