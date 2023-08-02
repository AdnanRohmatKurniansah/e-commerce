<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    public function profile() {
        return view('auth.account.profile', [
            'users' => Auth::user(),
            'title' => 'Account'
        ]);
    }
    public function update_profile(Request $request) {
        $users = Auth::user();

        $data = $request->validate([
            'profile' => 'file|max:2048',
            'gender' => 'required',
            'birth' => 'required'
        ]);

        if ($request->file('profile')) {
            if ($request->oldProfile) {
                Storage::delete($request->oldProfile);
            }
            $data['profile'] = $request->file('profile')->store('profile-images');
        }   

        User::where('id', $users->id)
            ->update($data);
        
        return back()->with('update', 'Your Profile has been updated!');
    }
    public function change_password() {
        return view('auth.account.changePassword', [
            'title' => 'Change Password'
        ]);
    }
    public function update_password(Request $request) {
        $data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        if(!Hash::check($data['old_password'], auth()->user()->password)){
            return back()->with('error', 'Old Password Doesnt match!');
        } else {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($data['new_password'])
            ]);

            return back()->with('update', 'Password Changed Successfuly!');
        }
    }
    public function forgetPassword() 
    {
        return view('auth.forgetPassword', [
            'title' => 'Reset Password'
        ]);
    }
    public function submitForgetPassword(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $provider = User::where('email', $request->email)
            ->whereNotNull('provider')->first();

        if ($provider) {
            return back()->with('error', 'Email has been registered with provider');
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('auth.email.forgetPassword', [
            'token' => $token
        ], function($message) use($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
    }
    public function showResetPasswordForm($token) 
    { 
        return view('auth.forgetPasswordLink', [
            'token' => $token,
            'title' => 'Reset Password'
        ]);
    }
    public function submitResetPasswordForm(Request $request) 
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:5|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password)
            ]);
        
        DB::table('password_reset_tokens')->where([
            'email' => $request->email
        ])->delete();

        return redirect('/login')->with('update', 'Your password has been changed!');
    }
}
