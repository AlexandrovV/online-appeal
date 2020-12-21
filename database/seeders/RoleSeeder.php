<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = new Role();
        $roleAdmin->name = 'Admin';
        $roleAdmin->slug = 'admin';
        $roleAdmin->description = 'Administrator role';
        $roleAdmin->save();

        $roleStudent = new Role();
        $roleStudent->name = 'Student';
        $roleStudent->slug = 'student';
        $roleStudent->description = 'Student role';
        $roleStudent->save();

        $roleManager = new Role();
        $roleManager->name = 'Manager';
        $roleManager->slug = 'manager';
        $roleManager->description = 'Manager role';
        $roleManager->save();

        $roleDepartment = new Role();
        $roleDepartment->name = 'Department';
        $roleDepartment->slug = 'dept';
        $roleDepartment->description = 'Department role';
        $roleDepartment->save();
    }
}
