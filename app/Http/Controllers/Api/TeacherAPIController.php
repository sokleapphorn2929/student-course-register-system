<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teachers;
use Illuminate\Http\Request;

class TeacherAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teacher = Teachers::all();

        return response()->json([
            'message' => 'Get all teachers successfully',
            'data' => $teacher
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "teacher_name" => "required|string|max:255",
            "teacher_phone" => "required|string|max:10|regex:/^[0-9]+$/",
            "teacher_address" => "required|string|max:255",
            "teacher_dob" => "required|date|before:today",
            "hired_date" => "required|date|before:today",
        ]);

        $teacher = new Teachers();
        $teacher->fill($validated);
        $teacher->save();

        return response()->json([
            'message' => 'Create teacher successfully',
            'data' => $teacher
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teachers::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'Teacher not found!',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Get teacher successfully',
            'data' => $teacher
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $teacher = Teachers::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'Teacher not found!',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            "teacher_name" => "sometimes|string|max:255",
            "teacher_phone" => "sometimes|string|max:10|regex:/^[0-9]+$/",
            "teacher_address" => "sometimes|string|max:255",
            "teacher_dob" => "sometimes|date|before:today",
            "hired_date" => "sometimes|date|before:today",
        ]);

        $teacher->fill($validated);
        $teacher->save();

        return response()->json([
            'message' => 'Update teacher successfully',
            'data' => $teacher
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $teacher = Teachers::find($id);

        if (!$teacher) {
            return response()->json([
                'message' => 'Teacher not found!',
                'data' => null
            ], 404);
        }

        $teacher->delete();

        return response()->json([
            'message' => 'Delete teacher successfully',
            'data' => null
        ], 200);
    }
}
