<?php


namespace App\repository;


use App\Models\Appeal;
use Illuminate\Support\Facades\Log;

class AppealRepository
{
    public function save($studentId, $departmentId, $subjectId, $teacherId, $text)
    {
        $appeal = new Appeal();
        $appeal->student_id = $studentId;
        $appeal->department_id = $departmentId;
        $appeal->subject_id = $subjectId;
        $appeal->teacher_id = $teacherId;
        $appeal->text = $text;
        $appeal->save();
        Log::info("Appeal added:", ['text' => $text]);
    }

    public function findAll() {
        return Appeal::all();
    }

    public function studentsAppeals($studentId, $status)
    {
        if ($status != null) {
            return Appeal::where('student_id', $studentId)->where('status', $status)->get();
        } else {
            return Appeal::where('student_id', $studentId)->get();
        }
    }

    public function departmentAppeals($departmentId, $status)
    {
        if ($status != null) {
            return Appeal::where('department_id', $departmentId)->where('status', $status)->get();
        } else {
            return Appeal::where('department_id', $departmentId)->get();
        }
    }

    public function managerAppeals($status)
    {
        if ($status != null) {
            return Appeal::where('status', $status)->get();
        } else {
            return Appeal::all();
        }
    }

    public function accept($id)
    {
        $appeal = Appeal::where('id', $id)->first();
        $appeal->status = 'waiting';
        $appeal->save();
        Log::info("Appeal added:", ['id' => $id]);
    }

    public function approve($id)
    {
        $appeal = Appeal::where('id', $id)->first();
        $appeal->status = 'accepted';
        $appeal->save();
        Log::info("Appeal added:", ['id' => $id]);
    }

    public function cancel($id)
    {
        $appeal = Appeal::where('id', $id)->first();
        $appeal->status = 'cancelled';
        $appeal->save();
        Log::info("Appeal added:", ['id' => $id]);
    }
}
