<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use MongoDB\Laravel\Eloquent\Casts\ObjectId;
use MongoDB\BSON\ObjectId;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showDashboard()
    {
        $teachers = Teachers::all();
        $totalTeachers = Teachers::count();

        $students = Students::all();
        $totalStudents = Students::count();

        $courses = Courses::all();
        $totalCourses = Courses::count();

        return view("dashboard.dashboard", compact("students", "totalStudents","courses", "totalCourses", "teachers", "totalTeachers"));
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
    public function student(Request $request)
    {
        $request->validate([
            "std_name" => "required|string|max:255",
            "std_phone" => "required|string|max:10|regex:/^[0-9]+$/",
            "std_address" => "required|string|max:255",
            "std_dob" => "required|date|before:today",
            "course_id" => "required|exists:courses,_id",
        ]);

        $course = Courses::find($request->course_id);
            if (!$course) {
                return back()->withErrors(['course_id' => 'Selected course does not exist.'])->withInput();
            }

        $student_data = [
            "user_id" => Auth::user()->_id,
            "std_name" => $request->std_name,
            "std_phone" => $request->std_phone,
            "std_address" => $request->std_address,
            "std_dob" =>  $request->std_dob,
            "course_id" => $request->course_id,
        ];

        Students::create($student_data);

        return redirect()->route('student.submit')->with('success', 'Student has been added successfully!');
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
        $student = Students::find($id);

        if (!$student) {
            return redirect()->route('dashboard')->with('error', 'Course not found!');
        }

        $validated = $request->validate([
            "std_name" => "required|string|max:255",
            "std_phone" => "required|string|max:10|regex:/^[0-9]+$/",
            "std_address" => "required|string|max:255",
            "std_dob" => "required|date|before:today",
            "course_id" => "required|exists:courses,_id",
        ]);

        $student->std_name       = $validated['std_name'];
        $student->std_phone = $validated['std_phone'];
        $student->std_address       = $validated['std_address'];
        $student->std_dob       = $validated['std_dob'];
        $student->course_id       = $validated['course_id'];
        $student->save();

        return redirect()->route('teacher')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Students::findOrFail($id)->delete();
        
        return redirect()->route('student.submit')->with('success', 'Student deleted successfully!');
    }
}
