<?php

namespace App\Http\Livewire\Employees;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class EmployeeIndexLivewire extends Component
{
    public $department = "";
    public $search = '';

    public $employeeId = '';
    public $confirmed = false;

    public $selectedEmployees = [];


    public function render()
    {
        $employees = Employee::query();

        if ($this->department != '') {
            $employees->where('department_id', $this->department);
        }

        if ($this->search != '') {
            $employees->where(function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%');
            });
        }

        $employees = $employees->get();

        return view(
            'livewire.employees.employee-index-livewire',
            [
                'employees' => $employees
            ]
        )->extends('layouts.autenticado')->section('main-content');
    }

    function deleteEmployee(int $id)
    {
        if ($this->employeeId == $id) {
            Employee::find($id)->delete();
            $this->employeeId = '';

        } else {
            $this->employeeId = $id;
        }
    }

    public function deleteSelected()
    {
        $uuids = array_keys(collect($this->selectedEmployees)
            ->filter(function ($element, $uuid) {
                return $element == true;
            })
            ->toArray());


        Employee::whereIn('uuid', $uuids, )
            ->delete();

    }
}
