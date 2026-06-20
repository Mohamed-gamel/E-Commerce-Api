<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Http\Resources\CategoryResource;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();
        return CategoryResource::collection($categories);
    }

    public function show(Categories $id)
    {
        if (!$id) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return CategoryResource::make($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Categories::create($request->all());
        return response()->json($category, 201);
    }

    public function update(Request $request, Categories $id)
    {
        if (!$id) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $id->update($request->all());
        return CategoryResource::make($id);
    }

    public function destroy(Categories $id)
    {
        if (!$id){
            return response()->json(['message' => 'Category not found'], 404);
        }
        $id->delete();
        return response()->json(['message' => 'Category Deleted']);
    }
}
