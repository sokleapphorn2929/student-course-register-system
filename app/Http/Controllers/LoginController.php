<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\FuncCall;
use SebastianBergmann\CodeCoverage\Test\Target\Function_;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        return view("auth.login");
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
    public function login(Request $request)
    {
        $credential = $request->validate([
            "email" => "required | string | email | max:255",
            "password" => "required | string | min:8",
        ]);

        if(!Auth::attempt($credential)){
            return back()
            ->withErrors(["email"=>"Invalid email or password!!"])
            ->withInput($request->only("email"));
        }

        if(Auth::attempt($credential)){
            $request->session()->regenerate();
            return redirect()->intended(route("dashboard"))->with("success","Login Successful!");
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route("login");
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
