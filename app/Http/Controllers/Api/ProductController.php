<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $products = Product::when($request->category, function ($query) use ($request) {
            return $query->where('category', $request->category);
        })->when($request->keyword, function ($query) use ($request) {
            return $query->where('name', 'LIKE', "%$request->keyword%")
                ->orWhere('description', 'LIKE', "%$request->keyword%");
        });

        $products->paginate(5); // pagination

        return ProductResource::collection($products);
    }
}
