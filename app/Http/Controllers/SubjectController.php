<?php

namespace App\Http\Controllers;

use App\repository\SubjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    protected $repository;

    public function __construct(SubjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $subjects = $this->repository->findAll();
        return view('subject.index', compact('subjects'));
    }

    public function create()
    {
        return view('subject.create');
    }

    public function store(Request $request)
    {
        try {
            $this->repository->save($request->input('name'), $request->input('departmentId'));
            return redirect()->route('subject-all')->with('status', 'success');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('subject-all')->with('status', 'fail');
        }
    }

    public function show($id)
    {
        $subject = $this->repository->findById($id);
        return view('subject.subject', compact('subject'));
    }

    public function edit($id)
    {
        $subject = $this->repository->findById($id);
        return view('subject.edit', compact('subject'));
    }

    public function update(Request $request)
    {
        try {
            $this->repository->update($request->input('id'), $request->input('name'), $request->input('departmentId'));
            return redirect()->route('subject-all')->with('status', 'updated');
        } catch (\Exception $exception) {
            Log::error($exception -> getMessage());
            return redirect()->route('subject-all')->with('status', 'fail');
        }
    }

    public function destroy($id)
    {
        $this->repository->deleteById($id);
        return redirect()->route('subject-all')->with('status', 'success');
    }
}
