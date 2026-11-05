<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CustomerAuthController
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
    $Customer=Customer::where('email', request('email'))->first();

        if (!$Customer || !Hash::check(request('password'), $Customer->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $Customer->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }
    
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

