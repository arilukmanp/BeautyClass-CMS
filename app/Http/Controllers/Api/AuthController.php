<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function signin(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // return response()->json(compact('token'));

        return response()->json([
            'id'    => $request->user()->id,
            'token' => $token,
            'name'  => $request->user()->profile->name,
            'photo' => $request->user()->profile->photo
        ]);
    }
}
