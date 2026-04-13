<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Exception;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showCourse()
    {
        $teachers = Teachers::all();
        $totalTeachers = Teachers::count();

        $students = Students::all();
        $totalStudents = Students::count();

        $courses = Courses::all();
        $totalCourses = Courses::count();

        $enrollments = Enrollments::all();

        $statuses = [
            (object)['_id' => 'pending',   'status_title' => 'Pending'],
            (object)['_id' => 'active',    'status_title' => 'Active'],
            (object)['_id' => 'completed', 'status_title' => 'Completed'],
            (object)['_id' => 'dropped',   'status_title' => 'Dropped'],
        ];

        $activeCount    = Enrollments::where('status', 'active')->count();
        $pendingCount   = Enrollments::where('status', 'pending')->count();
        $completedCount = Enrollments::where('status', 'completed')->count();
        $droppedCount   = Enrollments::where('status', 'dropped')->count();

        return view("dashboard.course", compact("students", "totalStudents","courses", "totalCourses", "teachers", "totalTeachers", "enrollments", "statuses",
        "activeCount", "pendingCount", "completedCount", "droppedCount"));
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
            "teacher_id"=>"required|exists:teachers,_id",
            "course_description"=>"nullable|string|min:1",
            "course_price"=>"required|numeric|min:10|max:999.99",
        ]);

        $course_data = [
            "course_title"=>$request->course_title,
            "teacher_id"=>$request->teacher_id,
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
        $course = Courses::find($id);

        if (!$course) {
            return redirect()->route('course')->with('error', 'Course not found!');
        }

        $validated = $request->validate([
            "course_title" => "required|string|max:255|unique:courses,course_title,{$id},_id",
            "teacher_id"=>"required|exists:teachers,_id",
            "course_description"=>"nullable|string|min:1",
            "course_price"=>"required|numeric|min:10|max:999.99",
        ]);

        $course->course_title       = $validated['course_title'];
        $course->teacher_id       = $validated['teacher_id'];
        $course->course_description = $validated['course_description'];
        $course->course_price       = $validated['course_price'];
        $course->save();

        return redirect()->route('course')->with('success', 'Course updated successfully!');
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
