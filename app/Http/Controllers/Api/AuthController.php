<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Services\CloudinaryService;

class AuthController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}
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
        $validated = $request->validate([
            "username" => "required | string | max:255",
            "email" => "required | string | email | unique:users,email | max:255",
            "password" => "required | string | min:8",
            "profile_pic" => "nullable | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
            'role' => 'required|in:Admin,Student,Teacher',
            'gender' => 'nullable|string|in:Male,Female',
            'dob' => 'nullable|date|before:today'
        ]);

        // $profile_pic = null;
        // if($request->hasFile('profile_pic')){
        //     $profile_pic = $request->file('profile_pic')->store('profile-pictures', 'public');
        // }

        $profile_pic_url       = null;
        $profile_pic_public_id = null;

        if ($request->hasFile('profile_pic')) {
            $result = $this->cloudinary->upload(
                $request->file('profile_pic')->getRealPath(),
                ['folder' => 'profile-pictures']
            );
            $profile_pic_url       = $result['secure_url'];
            $profile_pic_public_id = $result['public_id'];
        }

        $user = Users::create([
            "username"    => $request->username,
            "email"       => $request->email,
            "password"    => Hash::make($request->password),
            // "profile_pic" => $profile_pic,
            "profile_pic"           => $profile_pic_url,        // store URL
            "profile_pic_public_id" => $profile_pic_public_id,
            'role'        => $request->role,
            "gender"      => $request->gender,
            "dob"         => $request->dob
        ]);
            

        // $user = Users::create($validated);

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

    public function logout(Request $request){
        $user = $request->user();

        if($user){
            $user -> tokens() -> delete();
        }

        $cookie = Cookie::forget("auth_token");

        return response()->json([
            "message" => "Logout Successful!",
        ],200)->withCookie($cookie);
    }

    public function me(Request $request){
        $user = $request->user();
        return response()->json([
            "message" => "Get user information successful!",
            "data" => $user
        ],200);
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
        $user = Users::find($id);
        if(!$user){
            return response()->json([
                "message" => "User not found!"
            ],404);
        }

        $validated = $request->validate([
            "username" => "sometimes | string | max:255",
            "email" => "sometimes | string | email | unique:users,email | max:255",
            "password" => "sometimes | string | min:8",
            "profile_pic" => "sometimes | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
            'role' => 'sometimes|in:Admin,Student,Teacher',
            'gender' => 'sometimes|string|in:Male,Female',
            'dob' => 'sometimes|date|before:today'
        ]);

        // if($request->hasFile("profile_pic")){
        //     if($user->profile_pic && Storage::disk("public")->exists($user->profile_pic)){
        //         Storage::disk("public")->delete($user->profile_pic);
        //     }
        //     $validated["profile_pic"] = $request->file('profile_pic')->store('profile-pictures', 'public');
        // }

        if ($request->hasFile('profile_pic')) {

            // Delete old image from Cloudinary
            if ($user->profile_pic_public_id) {
                $this->cloudinary->delete($user->profile_pic_public_id);
            }

            // Upload new image
            $result = $this->cloudinary->upload(
                $request->file('profile_pic')->getRealPath(),
                ['folder' => 'profile-pictures']
            );

            $validated['profile_pic']           = $result['secure_url'];
            $validated['profile_pic_public_id'] = $result['public_id'];
        }

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user -> update($validated);

        return response()->json([
            "message" => "User update successful!",
            "data" => $user
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = Users::find($id);
        if(!$user){
            return response()->json([
                "message" => "User not found!"
            ],404);
        }

        // if($user->profile_pic && Storage::disk("public")->exists($user->profile_pic)){
        //     Storage::disk("public")->delete($user->profile_pic);
        // }

        if ($user->profile_pic_public_id) {
            $this->cloudinary->delete($user->profile_pic_public_id);
        }

        $user->delete();

        return response()->json([
            'message' => 'Delete user successfully',
            'data' => null
        ], 200);
    }
}
