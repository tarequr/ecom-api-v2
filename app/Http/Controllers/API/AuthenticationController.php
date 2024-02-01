<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login(Request $request)
    {
        $credintials = [
            "email" => $request->email,
            "password" => $request->password,
        ];

        $user = Auth::attempt($credintials);

        if (!$user) {
            return response('Invalid credentials', 401);
        }

        $token = $request->user()->createToken("test token");

        return response()->json([
            'user' => new UserResource(auth()->user()),
            'type' => 'Bearer',
            'access_token' => $token->plainTextToken
        ], 200);
    }
}
