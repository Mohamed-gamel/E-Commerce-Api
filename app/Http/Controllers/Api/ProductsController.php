<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all();
        return ProductResource::collection($products);
        // return response()->json([
        //     'data' => $products
        // ], 200);
    }

    public function show(Products $id)
    {
        if (!$id) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }
        return ProductResource::make($id);
        // return response()->json([
        //     'data' => $id
        // ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'integer',
        ]);

        $product = Products::create($request->all());

        return response()->json([
            'data' => $product
        ], 201);
    }

    public function update(Request $request, Products $id)
    {
        if (!$id) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric',
            'stock' => 'integer',
            'category_id' => 'integer',
        ]);

        $id->update($request->all());

        return ProductResource::make($id);
        // return response()->json([
        //     'data' => $id
        // ], 200);
    }

    public function destroy(Products $id)
    {
        if (!$id) {
            return response()->json([
                'message' => 'Product not found'
            ], 404);
        }

        $id->delete();

        return response()->json([
            'message' => 'Product deleted successfully'
        ], 200);
    }
}

