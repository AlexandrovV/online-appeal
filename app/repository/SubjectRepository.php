<?php


namespace App\repository;


use App\Models\Subject;
use Illuminate\Support\Facades\Log;

class SubjectRepository
{
    public function save($name, $departmentId) {
        $subject = new Subject();
        $subject -> subject_name = $name;
        $subject -> department_id = $departmentId;
        $subject->save();
        Log::info("Subject added:", ['name' => $subject -> subject_name]);
    }

    public function update($id, $name, $departmentId) {
        try {
            Subject::query()->where('id', $id)->update(['subject_name'=> $name, 'department_id' => $departmentId]);
            Log::info("Subject updated: ", ['name' => $name,'id' => $id]);
            return $id;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function findById($id) {
        return Subject::query()->findOrFail($id);
    }

    public function findAll() {
        return Subject::all();
    }

    public function deleteById($id) {
        Subject::destroy($id);
        Log::info("Subject deleted: ", ['id' => $id]);
        return $id;
    }
}
