<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Controllers\JsonResponse;
use App\Models\Order;
use App\Models\Order_item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display the order history for the authenticated user.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) //view order history
    {
      $user = Auth::user();
      $orders = Order::where('user_id', $user->id)->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user'], 404);
        }

      return response()->json(['orders' => $orders], 200);
    }

    /**
     * Store a newly created order in the database.
     *
     * @param Request $request
     * @return JsonResponse
     */
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
