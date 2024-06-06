<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            $userDetail = User::where('id', $user->id)->first();
            $token = $userDetail->createToken('auth_token')->plainTextToken;
            return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function getUser(Request $request)
    {
        $user = User::where('id', $request->user()->id)->with(['teacherProfile', 'parentProfile']);
        return response()->json($user->get());
    }
}
