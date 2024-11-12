<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            Log::info('Registration attempt', ['email' => $request->email]);

            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                Log::error('Registration validation failed', ['errors' => $validator->errors()]);
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first()
                ], 422);
            }

            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => explode('@', $request->email)[0],
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            Log::info('User registered successfully', ['user_id' => $user->id]);

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'token' => $token,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Registration failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
}
