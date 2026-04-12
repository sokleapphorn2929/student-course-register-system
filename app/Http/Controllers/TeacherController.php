<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showTeacher()
    {
        $teachers = Teachers::all();
        $totalTeachers = Teachers::count();

        $students = Students::all();
        $totalStudents = Students::count();

        $courses = Courses::all();
        $totalCourses = Courses::count();

        return view("dashboard.teacher", compact("students", "totalStudents","courses", "totalCourses", "teachers", "totalTeachers"));
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
    public function teacher(Request $request)
    {
        $request->validate([
            "teacher_name" => "required|string|max:255",
            "teacher_phone" => "required|string|max:10|regex:/^[0-9]+$/",
            "teacher_address" => "required|string|max:255",
            "teacher_dob" => "required|date|before:today",
            "hired_date" => "required|date|before:today",
        ]);

        $teacher_data = [
            "user_id"         => Auth::user()->_id,
            "teacher_name" => $request->teacher_name,
            "teacher_phone" => $request->teacher_phone,
            "teacher_address" => $request->teacher_address,
            "teacher_dob" =>  $request->teacher_dob,
            "hired_date" => $request->hired_date,
        ];

        Teachers::create($teacher_data);

        return redirect()->route('teacher.submit')->with('success', 'Teacher has been added successfully!');
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
        $teacher = Teachers::find($id);

        if (!$teacher) {
            return redirect()->route('teacher.update')->with('error', 'Teacher not found!');
        }

        $validated = $request->validate([
            "teacher_name" => "required|string|max:255",
            "teacher_phone" => "required|string|max:10|regex:/^[0-9]+$/",
            "teacher_address" => "required|string|max:255",
            "teacher_dob" => "required|date|before:today",
            "hired_date" => "required|date|before:today",
        ]);

        $teacher->teacher_name = $validated['teacher_name'];
        $teacher->teacher_phone = $validated['teacher_phone'];
        $teacher->teacher_address = $validated['teacher_address'];
        $teacher->teacher_dob = $validated['teacher_dob'];
        $teacher->hired_date = $validated['hired_date'];
        $teacher->save();

        return redirect()->route('teacher')->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Teachers::findOrFail($id)->delete();
        
        return redirect()->route('teacher.submit')->with('success', 'Teacher deleted successfully!');
    }
}
