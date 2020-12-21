<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug', 'admin')->first();
        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@example.com';
        $admin->password = 'pass';
        $admin->save();

        $admin->assignRole($adminRole);


        $managerRole = Role::where('slug', 'manager')->first();
        $manager = new User();
        $manager->name = 'manager';
        $manager->email = 'manager@example.com';
        $manager->password = 'pass';
        $manager->save();

        $manager->assignRole($managerRole);


        $studentRole = Role::where('slug', 'student')->first();
        $student = new User();
        $student->name = 'student';
        $student->email = 'student@example.com';
        $student->password = 'pass';
        $student->save();

        $student->assignRole($studentRole);


        $departmentRole = Role::where('slug', 'dept')->first();
        $department = new User();
        $department->name = 'dept';
        $department->email = 'dept@example.com';
        $department->password = 'pass';
        $department->save();

        $department->assignRole($departmentRole);
    }
}
