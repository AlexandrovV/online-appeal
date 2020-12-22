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

    public function studentAppeals() {
        $user = Auth::user();
        $appeals = $this->repository->studentsAppeals($user->id, null);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function studentStatusAppeals($status) {
        $user = Auth::user();
        $appeals = $this->repository->studentsAppeals($user->id, $status);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function managerAppeals() {
        $appeals = $this->repository->managerAppeals(null);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function managerStatusAppeals($status) {
        $appeals = $this->repository->managerAppeals($status);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function departmentAppeals() {
        $user = Auth::user();
        $appeals = $this->repository->departmentAppeals($user->department_id, null);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function departmentStatusAppeals($status) {
        $user = Auth::user();
        $appeals = $this->repository->departmentAppeals($user->department_id, $status);
        $statuses = ['created'=>'Создана','waiting'=>'На рассмотрении','accepted'=>'Подтверждена','cancelled'=>'Отменена'];
        return view('appeal.index', compact('appeals', 'statuses'));
    }

    public function accept($id) {
        try {
            $this->repository->accept($id);
            return redirect()->back()->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->back()->with('status', 'fail');
        }
    }

    public function approve($id) {
        try {
            $this->repository->approve($id);
            return redirect()->back()->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('appeal-form')->with('status', 'fail');
        }
    }

    public function cancel($id) {
        try {
            $this->repository->cancel($id);
            return redirect()->back()->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->back()->with('status', 'fail');
        }
    }
}
