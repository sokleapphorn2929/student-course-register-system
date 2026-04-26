<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollments;
use App\Models\Students;
use Illuminate\Http\Request;

class StudentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = Students::all();

        return response()->json([
            'message' => 'Get all students successfully!',
            'data' => $student->load('course')
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "std_name" => "required|string|max:255",
            "std_phone" => "required|string|max:10|regex:/^[0-9]+$/",
            "std_address" => "required|string|max:255",
            "std_dob" => "required|date|before:today",
            "course_id" => "required|exists:courses,_id",
        ]);

        $student = new Students();
        $student->fill($validated);
        $student->save();

        return response()->json([
            'message' => 'Create student successfully',
            'data' => $student->load("course")
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Students::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found!',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Get student successfully',
            'data' => $student->load("course")
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Students::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found!',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            "std_name" => "sometimes|string|max:255",
            "std_phone" => "sometimes|string|max:10|regex:/^[0-9]+$/",
            "std_address" => "sometimes|string|max:255",
            "std_dob" => "sometimes|date|before:today",
            "course_id" => "sometimes|exists:courses,_id",
        ]);

        $student->fill($validated);
        $student->save();

        return response()->json([
            'message' => 'Update student successfully',
            'data' => $student->load("course")
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Students::find($id);

        if (!$student) {
            return response()->json([
                'message' => 'Student not found!',
                'data' => null
            ], 404);
        }

        $student->enrollments()->delete();

        $student->delete();

        return response()->json([
            'message' => 'Delete student successfully',
            'data' => null
        ], 200);
    }
}
