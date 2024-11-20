<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImgBBHelper;

class AuthController extends Controller
{
    private $imgBBApiKey = '850208925c2606494ecd65c4b368ad04';

    public function register(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create($fields);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials.'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully.'
        ], 200);
    }

    public function editProfile(Request $request)
    {
        $user = $request->user();

        $fields = $request->validate([
            'userFirstName' => 'sometimes|string|max:255',
            'userMiddleName' => 'sometimes|string|max:255',
            'userLastName' => 'sometimes|string|max:255',
            'userAddress' => 'sometimes|string|max:255',
            'userProfilePicRef' => 'sometimes|image|mimes:jpeg,png,jpg,svg|max:512'
        ]);

        if ($request->hasFile('userProfilePicRef')) {
            $uploadedUrl = ImgBBHelper::uploadToImgBB($request->file('userProfilePicRef'), $this->imgBBApiKey);
            if ($uploadedUrl) {
                $fields['userProfilePicRef'] = $uploadedUrl;
            }
        }

        $user->update($fields);

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user' => $user
        ], 200);
    }

    public function forgotPassword(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|email|exists:users,email',
            'newPassword' => 'required|confirmed',
        ]);

        $user = User::where('email', $fields['email'])->first();

        $user->update([
            'password' => Hash::make($fields['newPassword']),
        ]);

        $user->tokens()->delete();

        return response()->json([
            'message' => 'Password reset successfully. Please log in with your new password.',
        ], 200);
    }

    public function getNotifications(Request $request)
    {
        $notifications = $request->user()->notifications;
        return response()->json($notifications, 200);
    }
}
