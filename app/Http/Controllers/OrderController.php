<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use App\Models\Order_item;
class OrderController extends Controller
{
    public function index(Request $request) //view order history
    {
      $user = Auth::user();
      $orders = Order::where('user_id', $user->id)->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

      return response()->json(['orders' => $orders], 200);
    }
   public function store(Request $request)
   {
       $request->validate([
           'items' => 'required|array',
           'items.*.product_id' => 'required|exists:products,id',
           'items.*.quantity' => 'required|integer|min:1',
       ]);

       $user = Auth::user();
       $totalPrice = 0;

       foreach ($request->items as $item) // determine total price of order
       {
           $product = Product::findOrFail($item['product_id']);
           $totalPrice += $product->price * $item['quantity'];
       }

       $order = Order::create([
           'user_id' => $user->id,
           'total_price' => $totalPrice,
           'status' => 1,
       ]);

       foreach ($request->items as $item)
           {
               Order_Item::create([
                   'order_id' => $order->id,
                   'product_id' => $item['product_id'],
                   'quantity' => $item['quantity'],
                   'price' => Product::find($item['product_id'])->price
               ]);
           }

       return response()->json(['message' => 'Order created', 'order'=> $order], 201);
   }

}
