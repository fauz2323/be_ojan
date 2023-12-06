<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserAplikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //check username
        $user = UserAplikasi::where('username', $request->username)->first();

        //check password
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Wrong username or password'
            ], 422);
        }

        //delete Token
        $user->tokens()->delete();

        //create token
        $token = $user->createToken('token_apps')->plainTextToken;

        //response
        return response()->json([
            'message' => 'Success login',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    //auth logout with sanctum
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Success logout'
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:user_aplikasis,username|alpha_num',
            'email' => 'required|unique:user_aplikasis,email|email',
            'name' => 'required',
            'password' => 'required',
        ]);


        $user = new UserAplikasi();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->nama = $request->name;
        $user->password = Hash::make($request->password);
        $user->save();

        $token = $user->createToken('token_apps')->plainTextToken;

        return response()->json([
            'message' => 'Success register',
            'token' => $token
        ], 200);
    }

    public function auth()
    {
        $user = UserAplikasi::find(Auth::user()->id);


        return response()->json([
            'message' => 'success get data',
            'user' => $user,
        ]);
    }
}
