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
        $credentials = $request->only('email', 'password');

        if ($request['departmentId'] == null) return back()->withErrors([
            'unexpected' => 'Укажите кафедру',
        ]);
        if ($request['name'] == null) return back()->withErrors([
            'name' => 'Укажите ФИО',
        ]);
        if ($request['email'] == null) return back()->withErrors([
            'email' => 'Укажите E-mail',
        ]);
        if ($request['password'] == null) return back()->withErrors([
            'password' => 'Укажите пароль',
        ]);
        if ($request['password'] != $request['passwordConfirm']) return back()->withErrors([
            'password-confirm' => 'Пароли не совпадают' ,
        ]);

        try {
            $user = new User();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->password = bcrypt($request['password']);
            $user->department_id = $request['departmentId'];
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
