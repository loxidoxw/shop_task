<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request) // get orders list
    {
        $query = Order::query();
        return response()->json($query->paginate(10));
    }

    public function show($id) // get order details
    {
         $order = Order::find($id);
         return response()->json($order);
    }

}
