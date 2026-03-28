<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Exception;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showCourse()
    {
        $courses = Courses::all();
        return view("dashboard.course",compact("courses"));
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
    public function course(Request $request)
    {
        $request->validate([
            "course_title"=>"required|string|unique:courses,course_title|max:255",
            "course_description"=>"nullable|string|min:1",
            "course_price"=>"required|numeric|min:10|max:999.99",
        ]);

        $course_data = [
            "course_title"=>$request->course_title,
            "course_description"=>$request->course_description,
            "course_price"=>$request->course_price,
        ];

        Courses::create($request->only(['course_title', 'course_description', 'course_price']));

        return redirect()->route('course')->with('success', 'Course has been added successfully!');

        // return redirect()->route("login")->with("success","Registered User");
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
        Courses::findOrFail($id)->delete();
        
        return redirect()->route('course')->with('success', 'Course deleted successfully!');
    }
}
