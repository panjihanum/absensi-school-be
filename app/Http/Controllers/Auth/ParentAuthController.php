<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ParentProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ParentAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'role' => 'PARENT',
            'password' => Hash::make($request->password),
        ]);

        ParentProfile::create([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'user_id' => $user->id,
        ]);

        return response()->json(['message' => 'Parent registered successfully'], 201);
    }
}
