<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Displays a list of product with optional filtering.
     *
     * @param Request $request HTTP request with optional filtering parameters.
     * @return \Illuminate\Http\JsonResponse JSON response with a paginated list of product.
     */
   public function index(Request $request) // show list of product
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

    /**
     * Display the specified product.
     *
     * @param int $id Product ID.
     * @return \Illuminate\Http\JsonResponse JSON response with product data.
     */
   public function show($id) // show only one requested product
   {
      $product = Product::find($id);
       if (!$product) {
           return response()->json(['message' => 'Product not found'], 404);
       }

       return response()->json($product);
   }


    /**
     * Store a newly created product in storage.
     *
     * @param Request $request HTTP request containing product data.
     * @return \Illuminate\Http\JsonResponse JSON response with the created product.
     */
   public function store(StoreRequest $request) // create new product
   {
       $validated = $request->validated();

       $product = Product::create($validated);

       return response()->json($product, 201);
   }

    /**
     * Update the specified product in storage.
     *
     * @param Request $request HTTP request containing updated product data.
     * @param int $id Product ID.
     * @return \Illuminate\Http\JsonResponse JSON response with the updated product.
     */
   public function update(UpdateRequest $request, $id)  //update product
   {
       $product = Product::find($id);

       if (!$product)
       {return response()->json(['message' => 'Product not found'], 404);}

       $validated = $request->validated();

       $product->update($validated);

       return response()->json($product);
   }

    /**
     * Remove the specified product from storage.
     *
     * @param int $id Product ID.
     * @return \Illuminate\Http\JsonResponse JSON response confirming deletion.
     */
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


