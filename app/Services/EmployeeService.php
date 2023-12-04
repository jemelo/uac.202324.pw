<?php

namespace App\Services;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmployeeService
{
    public function deleteEmployee(Employee $employee): bool
    {
        if (!Auth::user()->can('delete', $employee)) {
            throw new \Exception('Não tem permissões');
        }

        if ($employee->punchEvents()->count() > 0) {
            throw new \Exception('Não pode eliminar funcionarios com registos');
        }

        try {
            $employee->delete();
            return true;
        } catch (\Exception $exception) {
            throw new \Exception('Não foi possível remover o funcionário');
        }
    }
}
