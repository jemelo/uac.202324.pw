<div >
    <div class="row">
        <div class="col-6">
            <p class="lead">Filtro</p>
            <input type="text" wire:model.debounce.500ms="search" class="form-control">
        </div>
        <div class="col-4">
            <p class="lead">Departamento</p>


                <select wire:model="department" class="form-control" name="department" id="department">
                    <option value=""></option>
                    <option value="1">Contabilidade</option>
                </select>
        </div>


    </div>


        <div class="row mt-5">
            <div class="col">
                @can('create', \App\Models\Employee::class)
                    <p class="text-right">
                        <a href="{{ route('employees.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus fa-fw mr-2"></i>Adicionar Funcionário
                        </a>
                    </p>
                @endcan


                @if(collect($selectedEmployees)->filter(function ($element, $uuid) { return $element == true;})->count() > 0)
                    <button wire:click="deleteSelected" class="btn btn-lg btn-danger">Apagar Selecionados</button>
                @endif

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Código</th>
                        <th>Departamento</th>
                        <th class="text-end">Acções</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>
                                <input type="checkbox" wire:model="selectedEmployees.{{$employee->uuid}}">
                            </td>

                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->code }}</td>
                            <td>{{ optional($employee->department)->name }}</td>
                            <td class="text-end">
                                <a href="{{ route('employees.show', ['employee' => $employee]) }}" class="btn btn-primary btn-sm">Ver</a>

                                @can('update', $employee)
                                    <a href="{{ route('employees.edit', ['employee' => $employee]) }}" class="btn btn-warning btn-sm">Modificar</a>
                                @endcan

                                @can('delete', $employee)
                                    @if ($employee->id == $employeeId)
                                        <button wire:click="deleteEmployee({{ $employee->id }})" class="btn btn-danger">Tem a certeza?</button>
                                    @else
                                        <button wire:click="deleteEmployee({{ $employee->id }})" class="btn btn-danger">Apaga</button>
                                    @endif

                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

{{--                {{ $employees->links() }}--}}
            </div>
        </div>
</div>



