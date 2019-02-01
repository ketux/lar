<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
//use App\Post;
use DB;

class OrdersControllerKopinam extends Controller
{
    
    public function index()
    {      
        $orders = Order::sortable()->paginate(5);
		//$orders = Order::orderBy('kaina', 'asc')->paginate(5);
        return view('orders.index')->with('orders', $orders);
    }
	
	public function getCloneOrder($id) {
		$item = Order::find($id);
		$clone = $item->replicate();
		//unset($clone['pavadinimas'], $clone['aprasymas'], $clone['kaina'],$clone['cover_image']);
		$data = json_decode($clone, true);
		Order::create($data);

		$orders = Order::orderBy('pavadinimas', 'asc')->paginate(5);
		return redirect ('/orders')->with('success', 'Nukopijuota');
	}
	
	
	
}