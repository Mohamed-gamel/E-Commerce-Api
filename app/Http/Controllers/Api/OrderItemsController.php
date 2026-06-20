<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderitemResource;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    public function index()
    {
        $order = OrderItems::all();
        return OrderitemResource::collection($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            "order_id" => "required|integer",
            "product_id" => "required|integer",
            "quantity" => "integer",
            "price" => "numeric",
        ]);

        $request = OrderItems::create($request->all());
        return OrderitemResource::make($request);
    }

    public function show(OrderItems $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Orderitem not found"
            ],404);
        }
        return new OrderitemResource($id);
    }

    public function update(Request $request, OrderItems $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Orderitem not found"
            ],404);
        }

        $request->validate([
            "order_id" => "integer",
            "product_id" => "integer",
            "quantity" => "integer",
            "price" => "numeric",
        ]);
        $id->update($request->all());
        return OrderitemResource::make($id);
    }

    public function destroy(OrderItems $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Not found ID"
            ],404);
        }
        $id->delete();
        return response()->json(["message" => "Orderitem Deleted"]);
    }
}
