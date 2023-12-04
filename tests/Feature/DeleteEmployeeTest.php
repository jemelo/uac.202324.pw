<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\User;
use App\Services\EmployeeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class DeleteEmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_check_permission(): void
    {
        $service = new EmployeeService();
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => Str::random(8),
            'password' => '123',
            'is_admin' => true,
        ]);

        $userNormal = User::create([
            'name' => 'normal',
            'email' => Str::random(8),
            'password' => '123',
            'is_admin' => false,
        ]);


        $employee = Employee::create([
            'name' => Str::random(8),
            'code' => Str::random(8),
            'uuid' => Str::uuid()
        ]);
        Auth::login($userNormal);
        $this->expectExceptionMessage('Não tem permissões');
        $service->deleteEmployee($employee);

        Auth::login($userAdmin);
        $return = $service->deleteEmployee($employee);
        $this->assertTrue($return);
    }

    public function test_exists_employee()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => Str::random(8),
            'password' => '123',
            'is_admin' => true,
        ]);
        Auth::login($user);

        $service = new EmployeeService();
        $this->expectExceptionMessage('App\Models\Employee');
        $service->deleteEmployee(null);
    }

    public function test_no_history()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => Str::random(8),
            'password' => '123',
            'is_admin' => true,
        ]);

        $service = new EmployeeService();
        $employee = Employee::whereHas('punchEvents')->first();
        Auth::logout();
        Auth::login($user);
        $this->expectExceptionMessage('Não pode eliminar funcionarios com registos');
        $service->deleteEmployee($employee);
    }

    public function test_delete()
    {
        $user = User::create([
            'name' => 'admin',
            'email' => Str::random(8),
            'password' => '123',
            'is_admin' => true,
        ]);

        $service = new EmployeeService();
        $employee = Employee::whereDoesntHave('punchEvents')->first();
        Auth::logout();
        Auth::login($user);
        $return = $service->deleteEmployee($employee);
        $this->assertTrue($return);

        $this->assertDatabaseMissing('employees', ['id' => $employee->id, 'deleted_at' => null]);
    }
}
