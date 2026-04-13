<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Enrollments;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showEnrollment()
    {
        $teachers = Teachers::all();
        $totalTeachers = Teachers::count();

        $students = Students::all();
        $totalStudents = Students::count();

        $courses = Courses::all();
        $totalCourses = Courses::count();

        $enrollments = Enrollments::all();

        $activeCount    = Enrollments::where('status', 'active')->count();
        $pendingCount   = Enrollments::where('status', 'pending')->count();
        $completedCount = Enrollments::where('status', 'completed')->count();
        $droppedCount   = Enrollments::where('status', 'dropped')->count();

        $statuses = [
            (object)['_id' => 'pending',   'status_title' => 'Pending'],
            (object)['_id' => 'active',    'status_title' => 'Active'],
            (object)['_id' => 'completed', 'status_title' => 'Completed'],
            (object)['_id' => 'dropped',   'status_title' => 'Dropped'],
        ];

        return view("dashboard.enrollment", compact("students", "totalStudents","courses", "totalCourses", "teachers", "totalTeachers", "enrollments", "statuses",
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
    public function enrollment(Request $request)
    {
        $request->validate([
            "std_id" => "required|exists:students,_id",
            "course_id" => "required|exists:courses,_id",
            "status" => "required|in:pending,active,completed,dropped",
            "enrolled_at" => "required|date|before_or_equal:today",
            "payment_status" => "required|in:paid,unpaid,refunded",
        ]);

        $course = Courses::find($request->course_id);
        $student = Students::find($request->std_id);
        if (!$course) {
            return back()->withErrors(['course_id' => 'Selected course does not exist.'])->withInput();
        }
        if (!$student) {
            return back()->withErrors(['std_id' => 'Selected student does not exist.'])->withInput();
        }

        $enrollment_data = [
            "std_id" => $request->std_id,
            "course_id" => $request->course_id,
            "status" => $request->status,
            "enrolled_at" => $request->enrolled_at,
            "payment_status" => $request->payment_status,
        ];

        Enrollments::create($enrollment_data);

        return redirect()->route("enrollment.submit")->with("success", "Enrollment has been added successfully!");
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
        $enrollment = Enrollments::find($id);

        if(!$enrollment){
            return redirect()->route("enrollment")->with("error","Enrollment not found!");
        }

        $validate = $request->validate([
            "std_id" => "required|exists:students,_id",
            "course_id" => "required|exists:courses,_id",
            "status" => "required|in:pending,active,completed,dropped",
            "enrolled_at" => "required|date|before_or_equal:today",
            "payment_status" => "required|in:paid,unpaid,refunded",
        ]);

        $enrollment->std_id = $validate["std_id"];
        $enrollment->course_id = $validate["course_id"];
        $enrollment->status = $validate["status"];
        $enrollment->enrolled_at = $validate["enrolled_at"];
        $enrollment->payment_status = $validate["payment_status"];
        $enrollment->save();

        return redirect()->route("enrollment")->with("success","Enrollment update successfullyj!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Enrollments::findOrFail($id)->delete();

        return redirect()->route("enrollment.submit")->with("success","Enrollment deleted successfull!!");
    }
}
