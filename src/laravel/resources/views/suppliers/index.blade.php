@extends('adminlte::page')

@section('title', 'Cadastro de Fornecedor')

@section('content_header')
<h1>Fornecedor</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Fornecedor</h3>
    </div>

    <div class="card-body">
        <div>
            <a href="{{ route('supplier.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
        </div>
        <br>
        <table class="table table-bordered table-striped dataTable dtr-inline" id="supplier" style="font-size: 13px;">
            <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th style="width: 50%">Fornecedor</th>
                    <th style="width: 10%">Status</th>
                    <th style="width: 15%">Ações</th>
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
    $(document).ready(function () {

        $('#supplier').DataTable({
            language: {
                "url": "{{ asset('js/pt-br.json') }}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('supplier.index') }}",
            columns: [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'name',
                name: 'Fornecedor'
            },
            {
                data: 'is_active',
                name: 'is_active',
                render: function (data, type, row) {
                    return data ? 'Ativo' : 'Inativo';
                }
            },
            { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@stop