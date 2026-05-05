<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollments;
use Illuminate\Http\Request;

class EnrollmentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $enrollment = Enrollments::all();

        return response()->json([
            'message' => 'Get all enrollments successfully!',
            'data' => $enrollment->load(["student","course"])
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "std_id" => "required|exists:students,_id",
            "course_id" => "required|exists:courses,_id",
            "status" => "required|in:pending,active,completed,dropped",
            "enrolled_at" => "required|date|before_or_equal:today",
            "payment_status" => "required|in:paid,unpaid,refunded",
        ]);

        $enrollment = new Enrollments();
        $enrollment->fill($validated);
        $enrollment->save();

        return response()->json([
            'message' => 'Create enrollment successfully',
            'data' => $enrollment->load(["student","course"])
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $enrollment = Enrollments::findOrFail($id);

        if (!$enrollment) {
            return response()->json([
                'message' => 'Enrollment not found!',
                'data' => null
            ], 404);
        }

        return response()->json([
            'message' => 'Get enrollment successfully',
            'data' => $enrollment->load(["student","course"])
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $enrollment = Enrollments::findOrFail($id);

        if (!$enrollment) {
            return response()->json([
                'message' => 'Enrollment not found!',
                'data' => null
            ], 404);
        }

        $validated = $request->validate([
            "std_id" => "sometimes|exists:students,_id",
            "course_id" => "sometimes|exists:courses,_id",
            "status" => "sometimes|in:pending,active,completed,dropped",
            "enrolled_at" => "sometimes|date|before_or_equal:today",
            "payment_status" => "sometimes|in:paid,unpaid,refunded",
        ]);

        $enrollment->fill($validated);
        $enrollment->save();

        return response()->json([
            'message' => 'Update enrollment successfully',
            'data' => $enrollment->load(["student","course"])
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $enrollment = Enrollments::findOrFail($id);

        if (!$enrollment) {
            return response()->json([
                'message' => 'Enrollment not found!',
                'data' => null
            ], 404);
        }

        $enrollment->delete();

        return response()->json([
            'message' => 'Delete enrollment successfully',
            'data' => null
        ], 200);
    }
}
