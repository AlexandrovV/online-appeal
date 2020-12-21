<?php

namespace App\Http\Controllers;

use App\repository\DepartmentRepository;
use App\repository\TeacherRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{
    protected $teacherRepository;
    protected $departmentRepository;

    public function __construct(TeacherRepository $teacherRepository, DepartmentRepository $departmentRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        $teachers = $this->teacherRepository->findAll();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        try {
            $this->teacherRepository->save($request->first_name, $request->last_name, $request->middle_name, $request->department_id);
            return redirect()->route('department-all')->with('status', 'success');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('department-all')->with('status', 'fail');
        }
    }


    public function show($id)
    {
        $teacher = $this->teacherRepository->findById($id);
        return view('teacher.teacher', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit($id)
    {
        $teacher = $this->teacherRepository->findById($id);
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     */
    public function update(Request $request)
    {
        try {
            $this->teacherRepository->update($request->input('id'), $request->input('first_name'), $request->input('last_name'), $request->middle_name, $request->department_id);
            return redirect()->route('teacher-all')->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('teacher-all')->with('status', 'fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy($id)
    {
        $this->teacherRepository->deleteById($id);
        return redirect()->route('teacher-all')->with('status', 'success');
    }
}
