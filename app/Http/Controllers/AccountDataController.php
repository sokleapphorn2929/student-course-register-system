<?php

namespace App\Http\Controllers;

use App\Models\Enrollments;
use App\Models\Users;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountDataController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}
    
    public function showAccount()
    {
        $users = Users::all();

        return view('dashboard.account', compact("users"));
    }

    // Update username
    public function updateUsername(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|string|max:255|unique:users,username,' . Auth::id()
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $user = Auth::user();
            $user->username = $request->username;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Username updated successfully',
                'username' => $user->username
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update username: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update gender
    public function updateGender(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'gender' => 'required|string|in:Male,Female'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $user = Auth::user();
            $user->gender = $request->gender;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Gender updated successfully',
                'gender' => $user->gender
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update gender: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update date of birth
    public function updateDob(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'dob' => 'required|date|before:today'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $user = Auth::user();
            $user->dob = $request->dob;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Date of birth updated successfully',
                'dob' => $user->dob
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update date of birth: ' . $e->getMessage()
            ], 500);
        }
    }

    // Update profile picture
    public function updatePicture(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $user = Auth::user();
            
            // Delete old profile picture if exists
            if ($user->profile_pic) {
                $oldPath = storage_path('app/public/' . $user->profile_pic);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            
            // Store new profile picture
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('profile_pictures', $filename, 'public');
            
            $user->profile_pic = $path;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully',
                'path' => asset('storage/' . $path)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile picture: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteAccount()
    {
        $user = Auth::user();

        if ($user->profile_pic_public_id) {
            $this->cloudinary->delete($user->profile_pic_public_id);
        }
        
        Auth::logout();
        
        $user->delete();
        
        return redirect('/')->with('success', 'Your account has been deleted.');
    }
}