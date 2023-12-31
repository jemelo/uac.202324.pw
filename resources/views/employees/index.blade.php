@extends('layouts.autenticado')

@section('main-content')
<div class="container">
    <div class="row mt-5">
        <div class="col">
            @can('create', \App\Models\Employee::class)
            <p class="text-right">
                <a href="{{ route('employees.create') }}" class="btn btn-primary">
                    <i class="fa fa-plus fa-fw mr-2"></i>Adicionar Funcionário
                </a>
            </p>
            @endcan

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Código</th>
                        <th class="text-end">Acções</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->code }}</td>
                            <td class="text-end">
                                <a href="{{ route('employees.show', ['employee' => $employee]) }}" class="btn btn-primary btn-sm">Ver</a>

                                @can('update', $employee)
                                    <a href="{{ route('employees.edit', ['employee' => $employee]) }}" class="btn btn-warning btn-sm">Modificar</a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $employees->links() }}
        </div>
    </div>
</div>
@endsection
