<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('roles.index', compact('users'));
    }

    public function syncRoles(Request $request)
    {
        try {
            $user = User::where('id', $request['userId'])->first();
            $roles = array();
            if ($request['role_admin']) {
                array_push($roles, 'admin');
            }
            if ($request['role_manager']) {
                array_push($roles, 'manager');
            }
            if ($request['role_student']) {
                array_push($roles, 'student');
            }
            if ($request['role_dept']) {
                array_push($roles, 'dept');
            }
            $user->syncRoles($roles);

            return redirect()->route('roles-all')->with('status', 'success');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('roles-all')->with('status', 'fail');
        }
    }
}
