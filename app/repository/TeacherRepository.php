<?php


namespace App\repository;


use App\Models\Department;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;

class TeacherRepository
{
    public function save($first_name, $last_name, $middle_name, $department_id) {
        $teacher = new Teacher();
        $teacher -> first_name = $first_name;
        $teacher -> last_name = $last_name;
        $teacher -> middle_name = $middle_name;
        $teacher -> department_id = $department_id;
        $teacher->save();
        Log::info("Teacher added: ", ['last_name' => $last_name]);
    }

//
    public function update($id, $first_name, $last_name, $middle_name, $department_id) {
        try {
            Teacher::query()->where('id', $id)->update(['first_name'=> $first_name, 'last_name' => $last_name, 'middle_name' => $middle_name, 'department_id' => $department_id]);
            Log::info("Teacher updated: ", ['last_name' => $last_name,'id' => $id]);
            return $id;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function findById($id) {
        return Teacher::query()->findOrFail($id);
    }

    public function findAll() {
        return Teacher::all();
    }

    public function deleteById($id) {
        Teacher::destroy($id);
        Log::info("Teacher deleted: ", ['id' => $id]);
        return $id;
    }
}
