<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $order = Orders::all();
        return OrderResource::collection($order);
    }

    public function store(Request $request)
    {
        $request->validate([
            "user_id" => "required|integer",
            "total_price" => "numeric",
            "status" => "string",
        ]);

        $request = Orders::create($request->all());
        return OrderResource::make($request);
    }

    public function show(Orders $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Order not found"
            ],404);
        }
        return new OrderResource($id);
    }

    public function update(Request $request, Orders $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Order not found"
            ],404);
        }

        $request->validate([
            "user_id" => "integer",
            "total_price" => "numeric",
            "status" => "string",
        ]);
        $id->update($request->all());
        return OrderResource::make($id);
    }

    public function destroy(Orders $id)
    {
        if(!$id){
            return response()->json([
                "message" => "Not found ID"
            ],404);
        }
        $id->delete();
        return response()->json(["message" => "Order Deleted"]);
    }
}
