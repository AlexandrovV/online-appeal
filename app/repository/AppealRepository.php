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
}
