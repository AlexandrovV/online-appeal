<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use App\repository\AppealRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AppealController extends Controller
{
    protected $repository;

    public function __construct(AppealRepository $repository)
    {
        $this->repository = $repository;
    }

    public function form() {
        $user = Auth::user();
        $department = $user->department;
        $subjects = Subject::where('department_id', $department->id)->first();
        $teachers = Teacher::where('department_id', $department->id)->first();
        return view('appeal.form', compact('department', 'teachers', 'subjects'));
    }

    public function create(Request $request) {
        try {
            $this->repository->save(Auth::user()->id, $request['departmentId'], $request['subjectId'], $request['teacherId'], $request['text']);
            return redirect()->route('appeal-form')->with('status', 'success');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('appeal-form')->with('status', 'fail');
        }
    }
}
