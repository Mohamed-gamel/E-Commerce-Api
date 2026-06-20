<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return UserResource::collection($user);
        // return response()->json(['user' => $user], 200);
    }

    public function show()
    {
        $user = User::find(Auth::id());
        if ($user){
            return UserResource::make($user);
            // return response()->json(['user' => $user], 200);
        } else {
            return response()->json([null], 404);
        }
    }

    public function update(Request $requset)
    {
        $user = User::find(Auth::id());
        if ($user){
            $user->update($requset->all());
            return UserResource::make($user);
            // return response()->json(["message"=>"User Updated"], 200);
        } else {
            return response()->json([null], 404);
        }
    }

    public function delete()
    {
        $user = User::find(Auth::id());
        if ($user){
            PersonalAccessToken::where('tokenable_id', $user->id)->delete();
            $user->delete();
            return response()->json(["message"=>"User Deleted"], 200);
        } else {
            return response()->json([null], 404);
        }
    }
}
