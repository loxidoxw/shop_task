<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Displays a list of products with optional filtering.
     *
     * @param Request $request HTTP request with optional filtering parameters.
     * @return JsonResponse JSON response with a paginated list of products.
     */
   public function index(Request $request) // show list of products
   {
    $query = Product::query();

       //with category id
       if ($request->has('category_id')) {
           $query->where('category_id', $request->category_id);
       }
       //min price
       if ($request->has('min_price')) {
           $query->where('price', '>=', $request->min_price);
       }
       //max price
       if ($request->has('max_price')) {
           $query->where('price', '<=', $request->max_price);
       }
       return response()->json($query->paginate(10));
   }

   public function show($id) // show only one requested product
   {
      $product = Product::find($id);
       if (!$product) {
           return response()->json(['message' => 'Product not found'], 404);
       }

       return response()->json($product);
   }

   public function store(Request $request) // create new product
   {
       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'price' => 'required|numeric|min:0',
           'category_id' => 'required|exists:categories,id',
           'image' => 'nullable|string',
       ]);

       $product = Product::create($validated);

       return response()->json($product, 201);
   }

   public function update(Request $request, $id)  //update product
   {
       $product = Product::find($id);

       if (!$product)
       {return response()->json(['message' => 'Product not found'], 404);}

       $validated = $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'price' => 'required|numeric|min:0',
           'category_id' => 'required|exists:categories,id',
           'image' => 'nullable|image|max:2048',
       ]);

       $product->update($validated);

       return response()->json($product);
   }

   public function destroy($id) //delete product
   {
       $product = Product::find($id);

       if (!$product) {
           return response()->json(['message' => 'Product not found'], 404);
       }

       $product->delete();

       return response()->json(['message' => 'Product deleted']);
   }
}


