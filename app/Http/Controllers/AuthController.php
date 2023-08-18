<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response(['error' => 'User Not Found'], 404);
        }
        $token = $user->createToken($user->email);
        return UserResource::make($user)->additional(['data' => ['token' => $token->plainTextToken]]);

    }

    public function logout () {
        auth()->user()->currentAccessToken()->delete();
        auth()->guard('web')->logout();
        return response(['success' => true, 'message' => 'Logged out Successfully']);
    }
}
