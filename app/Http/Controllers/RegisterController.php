<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showRegister()
    {
        return view("auth.register");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $request->validate([
            "username" => "required | string | max:255",
            "email" => "required | string | email | unique:users,email | max:255",
            "password" => "required | string | min:8",
            "profile_pic" => "nullable | image | mimes:jpeg,png,jpg,gif,svg | max:2048",
        ]);

        $userData = [
            "username" => $request->username,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ];

        if ($request->hasFile('profile_pic')) {
            $path = $request->file('profile_pic')->store('uploads', 'public');
            $userData['profile_pic'] = $path;
        }

        try{
            Users::create($userData);
        }catch(Exception $err){
            if(str_contains($err->getMessage(),"E11000")) {
                return back()
                ->withErrors(["email"=>"Your email is already register!"]);
            }
            throw($err);
        }

        return redirect()->route("login")->with("success","Registered User");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
