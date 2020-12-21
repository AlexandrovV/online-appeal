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
        Department::created($department);
        Log::info("Department added:", $department -> name);
    }

    public function update($id, $department) {
        try {
            Department::query()->where('id', $id)->update($department);
            return $id;
        } catch (\Exception $e) {
            echo $e->getMessage();
            throw $e;
        }
    }

    public function findById($id) {
        return Department::query()->findOrFail($id);
    }

    public function findAll() {
        return Department::all();
    }

    public function deleteById($id) {
        return Department::destroy($id);
    }

}
