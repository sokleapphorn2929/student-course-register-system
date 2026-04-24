<?php

namespace App\Http\Controllers;

use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProfileController extends Controller
{
    public function __construct(
        protected CloudinaryService $cloudinary
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            "profile_picture" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        $user = Auth::user();

        try {
            // // Delete old profile picture if exists
            // if ($user->profile_pic && Storage::disk("public")->exists($user->profile_pic)) {
            //     Storage::disk("public")->delete($user->profile_pic);
            // }
    
            // // Store the file properly
            // $file = $request->file("profile_picture");
            // $fileName = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            // $path = $file->storeAs('profile-pictures', $fileName, 'public');
    
            // // Update user's profile_pic field in database
            // $user->profile_pic = $path;
            // $user->save();
    
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Profile picture updated successfully',
            //     'path' => asset('storage/' . $path)
            // ]);
            if($user->profile_pic_public_id){
                $this->cloudinary->delete($user->profile_pic_public_id);
            }

            $result = $this->cloudinary->upload(
                $request->file('profile_picture')->getRealPath(),
                ['folder' => 'profile-pictures']
            );

            $user->profile_pic           = $result['secure_url'];
            $user->profile_pic_public_id = $result['public_id'];
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile picture updated successfully',
                'path'    => $result['secure_url']
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update profile picture: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateRole(Request $request)
    {
        $request->validate([
            'role' => 'required|in:Admin,Student,Teacher'
        ]);

        try {
            Auth::user()->update(['role' => $request->role]);
            return response()->json(['success' => true, 'role' => $request->role]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to update role']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
