<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testHasAdminUser()
    {
        $this->assertDatabaseHas('users', ['email' => 'admin@example.com']);
    }

    public function testUserEmailIsUnique()
    {
        try {
            $admin = new User();
            $admin->name = 'admin';
            $admin->email = 'admin@example.com';
            $admin->password = bcrypt('pass');
            $admin->department_id = 1;
            $admin->save();

            self::assertTrue(false);
        } catch (\Exception $e) {
            self::assertTrue(true);
        }
    }
}
