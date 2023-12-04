<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class EmployeeAPIAccessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_index(): void
    {
        $response = $this->get(
            '/api/employees',
            [
                'Accept' => 'application/json',
            ]
        );
        $response->assertStatus(401);

        $user = User::create([
            'name' => 'admin',
            'email' => Str::random(8),
            'password' => '123',
            'is_admin' => true,
        ]);
        $token = $user->createToken('test_negativo', ['aaaa']);
        $plainTextToken = $token->plainTextToken;

        $response = $this->get(
            '/api/employees',
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken
            ]
        );
        $response->assertStatus(403);
    }

    public function test_ok()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => Str::random(8),
            'password' => '123',
            'is_admin' => true,
        ]);
        $token = $user->createToken('test_positivo', ['employees:list']);
        $plainTextToken = $token->plainTextToken;
        $response = $this->get(
            '/api/employees',
            [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $plainTextToken
            ]
        );
        $response->assertStatus(200);
    }
}
