@extends('adminlte::page')

@section('title', 'Cadastro de Pedidos')

@section('content_header')
<h1>Pedidos</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Lista de Pedidos</h3>
    </div>

    <div class="card-body">
        <div>
            <a href="{{ route('request.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
        </div>
        <br>
        <table class="table table-bordered table-striped dataTable dtr-inline" id="request" style="font-size: 13px;">
            <thead>
                <tr>
                    <th style="width: 5%">Id</th>
                    <th style="width: 15%">Venda</th>
                    <th style="width: 25%">Produto</th>
                    <th style="width: 10%">Quantidade</th>
                    <th style="width: 15%">Preço Unitário</th>
                    <th style="width: 15%">Preço Total</th>
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
        $('#request').DataTable({
            language: {
                "url": "{{ asset('js/pt-br.json') }}"
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('request.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'sale_id', name: 'sale_id' }, // ou 'sale_name' se quiser mostrar o nome
                { data: 'product_name', name: 'product_name' },
                { data: 'quantity', name: 'quantity' },
                { data: 'unit_price', name: 'unit_price' },
                { data: 'total_price', name: 'total_price' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@stop