<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;

class StaffAuthController
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $staff=Staff::where('email', request('email'))->first();

        if (!$staff || !Hash::check(request('password'), $staff->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $staff->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }

    /**
     * Display the currently authenticated user.
     */
    public function me(Request $request)
    {
        return response()->json(auth()->user());
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}