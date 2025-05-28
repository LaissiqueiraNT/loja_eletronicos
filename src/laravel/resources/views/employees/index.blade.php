@extends('adminlte::page')

@section('title', 'Cadastro de Funcionários')

@section('content_header')
    <h1>Funcionários</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Funcionários</h3>
        </div>

        <div class="card-body">
            <div>
                <a href="{{ route('employee.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
            </div>
            <br>
            <table class="table table-bordered table-striped dataTable dtr-inline" id="employee" style="font-size: 13px;">
                <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 30%">Nome</th>
                        <th style="width: 20%">Email</th>
                        <th style="width: 20%">Cargo</th>
                        <th style="width: 25%">Ações</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
@stop

@section('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap4.min.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#employee').DataTable({
                language: {
                    "url": "{{ asset('js/pt-br.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('employee.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'Nome'
                    },
                    {
                        data: 'email',
                        name: 'Email'
                    },
                    {
                        data: 'role_id',
                        name: 'Cargo',
                        render: function(data, type, row) {
                            return data == 0 ? 'Admin' : 'Funcionário';
                        }
                    },
                    {
                        data: 'action',
                        name: 'Ações',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@stop
