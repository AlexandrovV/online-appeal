<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function testHomeNotAvailableWithoutAuth()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }

    public function testHomeAuthenticated()
    {
        Auth::attempt(['email' => 'admin@example.com', 'password' => 'pass']);
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testLoginAvailable()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAdminHasRoleAdmin()
    {
        Auth::attempt(['email' => 'admin@example.com', 'password' => 'pass']);

        self::assertTrue(Auth::user()->hasRole('admin'));
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStudentDoesntHaveRoleAdmin()
    {
        Auth::attempt(['email' => 'student@example.com', 'password' => 'pass']);

        self::assertFalse(Auth::user()->hasRole('admin'));
    }
}
