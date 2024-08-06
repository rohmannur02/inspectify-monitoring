<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use \App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request) {
        $loginData = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where(['email' => $request->email])->first();

        if(!$user) {
            return response([
                'status' => 'error',
                'message' => 'email not found',
            ], 404);
        }

        if(!Hash::check($request->password, $user->password)) {
            return response([
                'status' => 'error',
                'message' => 'password is wrong',
            ], 404);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }
}