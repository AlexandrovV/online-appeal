<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\repository\DepartmentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DepartmentController extends Controller
{
    protected $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $departments = $this->repository->findAll();
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('department.create');
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
            $this->repository->save($request->input('name'), $request->input('departmentType'));
            return redirect()->route('department-all')->with('status', 'success');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('department-all')->with('status', 'fail');
        }
    }


    public function show($id)
    {
        $department = $this->repository->findById($id);
        return view('department.department', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit($id)
    {
        $department = $this->repository->findById($id);
        return view('department.edit', compact('department'));
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
            $this->repository->update($request->input('id'), $request->input('name'), $request->input('departmentType'));
            return redirect()->route('department-all')->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('department-all')->with('status', 'fail');
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
        $this->repository->deleteById($id);
        return redirect()->route('department-all')->with('status', 'success');
    }
}
