<?php


namespace App\repository;


use App\Models\Department;
use Illuminate\Support\Facades\Log;

class DepartmentRepository
{
    public function save($name, $departmentType) {
        $department = new Department();
        $department -> name = $name;
        $department -> department_type = $departmentType;
        $department->save();
        Log::info("Department added:", ['name' => $department -> name]);
    }

    public function update($id, $name, $department_type) {
        try {
            Department::query()->where('id', $id)->update(['name'=> $name, 'department_type' => $department_type]);
            Log::info("Department updated: ", ['name' => $name,'id' => $id]);
            return $id;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function findById($id) {
        return Department::query()->findOrFail($id);
    }

    public function findAll() {
        return Department::all();
    }

    public function deleteById($id) {
        Department::destroy($id);
        Log::info("Department deleted: ", ['id' => $id]);
        return $id;
    }
}
