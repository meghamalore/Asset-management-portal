<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user); // login user
            $request->session()->regenerate(); 

            return response()->json([
                'success' => true,
                'status' => 200,
                'message' => 'Login successful!!',
                'user' => $user,
                'redirect_url' => route('dashboard')
            ]);
        } else {

            return response()->json([
                'success' => false,
                'status' => 401,
                'message' => 'Invalid Username or Password'
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'status'=>200,
            'message'=>'Logout successful'
        ]);
    }
}
