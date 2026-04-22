<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Users::all();

        return response()->json([
            "message" => "Get all users successful!",
            "data" => $user
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "username" => "required | string | max:255",
            "email" => "required | string | email | unique:users,email | max:255",
            "password" => "required | string | min:8",
            "profile_pic" => "nullable | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
            'role' => 'required|in:Student,Teacher',
        ]);

        $user = Users::create([
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "profile_pic" => $request->profile_pic,
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'Create user successfully',
            'data' => $user
        ], 201);
    }

    public function login(Request $request){
        $request->validate([
            "email" => "required | string | email | max:255",
            "password" => "required | string | min:8",
        ]);

        $user = Users::where("email",$request->email)->first();
        if(!$user){
            return response()->json([
                "message" => "User not found!!"
            ],404);
        }

        if(!Hash::check($request->password,$user->password)){
            return response()->json([
                "message" => "Invalid credentials"
            ],401);
        }

        $token_result = $user->createToken("auth_token");
        $token = $token_result->plainTextToken;

        $cookie = cookie(
            "auth_token",
            $token,
            60*24,
            null,
            true,
            true,
            false,
            "Strict"
        );

        return response()->json([
            "message" => "Login Successful!",
            "data" => $user,
            "token" => $token
        ],200)->withCookie($cookie);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'User not found!',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Get user successfully',
            'data' => $user
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
