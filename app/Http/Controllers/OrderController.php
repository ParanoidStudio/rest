<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dish;
use App\Components;
use App\Order;
use App\User;
use App\Workers;
use DB;
use Auth;
class OrderController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        if ($user->admin) {
            $useradmin = true;
        } else {
            $useradmin = false;
        }
        session_start();
        $workers= Workers::all();
    	$dish = Dish::where('interim', false)->get();
    	return view('order.index', [
    		'dish' => $dish,
            'workers' => $workers,
            'useradmin' => $useradmin
		]);
    }
    public function store(Request $request)
    {
        session_start();
        $_SESSION['worker'] = $request->worker;
        $worker = $request->worker;
    	$dish = Dish::all();
    	$data = [];
    	foreach ($dish as $value) {
    		if (isset($_POST['dish-'.$value->id])) {
    			if ($_POST['dish-'.$value->id] != '' ) {
    				$data[$value->id] = $_POST['dish-'.$value->id];
    			}
    		}
    	}
    	$price = 0;
    	foreach ($dish as $value) {
    		foreach ($data as $key => $val) {
    			if ($value->id == $key) {
    				// Списывание ингридиентов
    				$arr = unserialize($value->components);
    				foreach ($arr as $key_2 => $comp) {
    					$new_count = $comp * $val;
    					$comparr = Components::where('id', $key_2)->first();
                        $count = $comparr->count - $new_count;
    					$bruto = $comparr->bruto - $new_count;
                        if ($comparr->kolvo) {
                            Components::where('id', $key_2)->update([
                                'count' => $count
                            ]);
                        } else {
                            Components::where('id', $key_2)->update([
                                'count' => $count,
                                'netto' => $count,
                                'bruto' => $bruto
                            ]);
                        }
                        // Доп. блюда
    				}
    				// Формируем цену
    				$price += $value->price * $val;
    			}
    		}
    	}
        $order = new Order;
        $order->dishes = serialize($data);
        $order->price = $price;
        $order->worker_id = $worker;
        $order->save();

        $dish = Dish::all();
        foreach ($dish as $value) {
            foreach ($data as $key => $val) {
                if ($value->id == $key) {
                    $disharr = unserialize($value->dishes);
                    if (!empty($disharr)) {
                        foreach ($disharr as $key => $dishelem) {
                            $dopdish = Dish::where('id', $key)->get();
                            foreach ($dopdish as $dishelem_2) {
                                $arr = unserialize($dishelem_2->components);
                                // Пошел цикл для списывания
                                foreach ($arr as $key_2 => $comp) {
                                    $new_count = (($comp * $val) / 1000) * $dishelem;
                                    $comparr = Components::where('id', $key_2)->first();
                                    $count = $comparr->count - $new_count;
                                    $bruto = $comparr->bruto - $new_count;
                                    if ($comparr->kolvo) {
                                        Components::where('id', $key_2)->update([
                                            'count' => $count
                                        ]);
                                    } else {
                                        Components::where('id', $key_2)->update([
                                            'count' => $count,
                                            'netto' => $count,
                                            'bruto' => $bruto
                                        ]);
                                    }
                                }
                            }
                        }   
                    }
                }
            }
        }
        echo "<div style='border: 1px solid gray; padding: 25px;'>";
        echo "<h3>Заказ №".$order->id."</h3>";
        
        foreach ($dish as $value) {
            foreach ($data as $key => $val) {
                if ($value->id == $key) {
                    // Списывание ингридиентов
                    echo $value->name.". кол-во ".$val. ". Цена: ".$value->price * $val;
                    echo "<br>";
                }
            }
        }
        echo "<b>Заказ успешно оформлен. Цена: ".$price." руб. </b>";
        echo "<br>";
        echo "<i>Дата: ".$order->created_at."</i>";
        echo "</div>";

    	echo "<br><a href='".route('orderindex')."'>Вернуться обратно</a>";
    }
    public function list(Request $request) {
    	$time_1 = strtotime($request->time_1);
        $time_1 = date("Y-m-d H:i:s", $time_1);
        $time_2 = strtotime($request->time_2);
        $time_2 = date("Y-m-d H:i:s", $time_2);
        if ($request->time_1 == '' && $request->time_2 == '' && $request->worker == '') {
            $order = Order::orderBy('id', 'desc')->get();
        } else {
            $query = DB::table('orders')->select();
            if ($request->time_1 != '') {
                $query->where('created_at', '>=',$time_1);
            }
            if ($request->time_2 != '') {
                $query->where('created_at', '<=',$time_2);
            }
            if ($request->worker != '') {
                $query->where('worker_id',$request->worker);

            }
            $order = $query->orderBy('id', 'desc')->get();
        }
        $workers = Workers::all();
    	$dish = Dish::all();
    	return view('order.list',[
    		'order' => $order,
    		'dish' => $dish,
            'workers' => $workers
    	]);
    }
    public function delete(Request $request) {
        Order::where('id', $request->id)->delete();
        return redirect()->back();
    }
}
