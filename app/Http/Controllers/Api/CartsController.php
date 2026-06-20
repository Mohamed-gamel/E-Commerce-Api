<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Carts;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function index()
    {
        $carts = Carts::all();
        return CartResource::collection($carts);
    }

    public function store(Request $request)
    {
        $request->validate([
            "user_id" => "required|integer"
        ]);

        $request = Carts::create($request->all());
        return CartResource::make($request);
    }

    public function show(Carts $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Cart not found"
            ],404);
        }
        return new CartResource($id);
    }

    public function update(Request $request, Carts $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Cart not found"
            ],404);
        }

        $request->validate([
            "user_id" => "required|integer"
        ]);
        $id->update($request->all());
        return CartResource::make($id);
    }

    public function destroy(Carts $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Not found ID"
            ],404);
        }
        $id->delete();
        return response()->json(["message" => "Cart Deleted"]);
    }
}
