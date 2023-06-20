<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register() {
        return view('auth.register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);   
        
        return redirect('/login')->with('success', 'Register Successfully');
    }
    
    public function login() {
        return view('auth.login', [
            'title' => "Login"
        ]);
    }

    public function auth(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);
    
        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user) {
            return back()->with('error', 'Login Failed');
        }
    
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();
    
            if ($user->role == 'admin') {
                return redirect()->intended('/dashboard')->with('success', 'Login successfully');
            } else {
                return redirect('/')->with('success', 'Login successfully');
            }
            
        }
        return back()->with('error', 'Login Failed');
    }
    public function logout() {
        Auth::logout();

        request()->session()->invalidate();
    
        request()->session()->regenerateToken();
    
        return redirect('/');
    }
}
