@extends('adminlte::page')

@section('title', 'Cadastro de Vendas')

@section('content_header')
<h1>Vendas</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Vendas</h3>
    </div>

    <div class="card-body">
        <div>
            <a href="{{ route('sale.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
        </div>
        <br>
        <table class="table table-bordered table-striped dataTable dtr-inline" id="sale" style="font-size: 13px;">
            <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th style="width: 20%">Cliente</th>
                    <th style="width: 20%">Funcionário</th>
                    <th style="width: 15%">Data</th>
                    <th style="width: 15%">Total</th>
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
        $('#sale').DataTable({
            language: {
                "url": "{{ asset('js/pt-br.json') }}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('sale.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'client_name', name: 'client_name' },
                { data: 'employee_name', name: 'employee_name' },
                { data: 'sale_date', name: 'sale_date' },
                { data: 'total_price', name: 'total_price' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@stop