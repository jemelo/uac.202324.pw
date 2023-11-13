<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\View\View;


class EmployeeControllerV1 extends Controller
{
    public function index(): View
    {
        $employees = Employee::orderBy('name')->paginate(25);
        return view(
            'employees.index',
            [
                'employees' => $employees
            ]
        );
    }
}
