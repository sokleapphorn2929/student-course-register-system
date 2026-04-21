<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;

class CourseAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course = Courses::all();

        return response()->json([
            'message' => 'Get all courses successfully',
            'data' => $course
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "course_title"=>"required|string|unique:courses,course_title|max:255",
            "teacher_id"=>"required|exists:teachers,_id",
            "course_description"=>"nullable|string|min:1",
            "course_price"=>"required|numeric|min:10|max:999.99",
        ]);

        $course = new Courses();
        $course->fill($validated);
        $course->save();

        return response()->json([
            'message' => 'Create course successfully',
            'data' => $course->load("Teachers")
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course not found!',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Get course successfully',
            'data' => $course->load("Teachers")
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course not found!',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            "course_title"=>"sometimes|string|unique:courses,course_title|max:255",
            "teacher_id"=>"sometimes|exists:teachers,_id",
            "course_description"=>"sometimes|string|min:1",
            "course_price"=>"sometimes|numeric|min:10|max:999.99",
        ]);

        $course->fill($validated);
        $course->save();

        return response()->json([
            'message' => 'Update course successfully',
            'data' => $course->load("Teachers")
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Courses::find($id);

        if (!$course) {
            return response()->json([
                'message' => 'Course not found!',
                'data' => null
            ], 404);
        }

        $course->delete();

        return response()->json([
            'message' => 'Delete course successfully',
            'data' => null
        ], 200);
    }
}
