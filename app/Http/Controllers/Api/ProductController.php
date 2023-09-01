<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Returns list of products
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Resource\Json\JsonResource
     */
    public function index(Request $request)
    {
        // filters
        $query = Product::when($request->category, function ($query) use ($request) {
            return $query->where('category', $request->category);
        })->when($request->keyword, function ($query) use ($request) {
            return $query->where(function ($q) use ($request) {
                $q->where('name', 'LIKE', "%$request->keyword%")
                    ->orWhere('description', 'LIKE', "%$request->keyword%");
            });
        });

        $products = $query->paginate(5); // pagination

        return ProductResource::collection($products);
    }

    /**
     * Deletes a product
     * 
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Product $product)
    {
        try {
            $product->delete();
        } catch (\Exception $e) {
            Log::error($e);

            return response()->json([
                'errors' => $e->getMessage()
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
