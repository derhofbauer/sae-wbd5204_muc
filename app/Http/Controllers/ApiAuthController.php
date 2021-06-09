<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{

    public function register (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }

        $user = new User([
            'email' => $request->post('email'),
            'name' => $request->post('name')
        ]);
        $user->password = $request->post('password');
        $user->save();

        return response()->json([
            'token' => $user->createToken('api-token')->plainTextToken
        ]);
    }

    public function login (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        if (!Auth::attempt($request->all())) {
            return response()->json([
                'error' => 'Credentials do not match'
            ], 401);
        }

        return response()->json([
            'token' => Auth::user()->createToken('api-token')->plainTextToken
        ]);
    }

    public function logout (Request $request)
    {
        Auth::user()->currentAccessToken()->delete();

        return response(null, 200);
    }

}
