<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function signUp(Request $request)
    {
        $credentials = $request->only('name', 'email', 'password', 'passwordConfirm');

        if ($credentials['name'] == null) return back()->withErrors([
            'name' => 'Name must be specified',
        ]);
        if ($credentials['email'] == null) return back()->withErrors([
            'email' => 'Email must be specified',
        ]);
        if ($credentials['password'] == null) return back()->withErrors([
            'password' => 'Password must be specified',
        ]);
        if ($credentials['password'] != $credentials['passwordConfirm']) return back()->withErrors([
            'password-confirm' => 'Password confirmation failed' ,
        ]);

        try {
            $user = new User($credentials);
            $user->name = $credentials['name'];
            $user->email = $credentials['email'];
            $user->password = bcrypt($credentials['password']);
            $user->save();

            $roleStudent = Role::where('slug', 'student')->first();
            $user->assignRole($roleStudent);

            if (Auth::attempt($credentials)) {
                return redirect('/');
            } else {
                return redirect('/login');
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors(['unexpected' => 'Unexpected error occured ' . $e->getMessage()]);
        }
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }
}
