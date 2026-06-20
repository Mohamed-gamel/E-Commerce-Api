<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartItemResource;
use App\Models\CartItems;
use Illuminate\Http\Request;

class CartitemsController extends Controller
{
    public function index()
    {
        $cartitems = Cartitems::all();
        return CartItemResource::collection($cartitems);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'numeric',
        ]);

        $request = CartItems::create($request->all());

        return new CartItemResource($request);
    }

    public function show(CartItems $id)
    {
        if(!$id)
        {
            return response()->json([
                'message' => 'CartItem not found'
            ], 404);
        }

        return new CartItemResource($id);
    }

    public function update(Request $request, CartItems $id)
    {
        if(!$id)
        {
            return response()->json([
                'message' => 'CartItem not found'
            ], 404);
        }

        $request->validate([
            'cart_id' => 'integer',
            'product_id' => 'integer',
            'quqntity' => 'numeric',
        ]);

        $id->update($request->all());
        return CartItemResource::make($id);
    }

    public function destroy(CartItems $id)
    {
        if(!$id)
        {
            return response()->json([
                'message' => 'CartItem not found'
            ], 404);
        }

        $id->delete();
        return response()->json([
            'message' => 'CartItem deleted successfully'
        ], 200);

    }
}
