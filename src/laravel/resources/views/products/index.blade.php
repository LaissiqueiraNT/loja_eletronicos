@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')

@section('content_header')
    <h1>Produtos</h1>
@stop

@section('plugins.Datatables', true)

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Lista de Produtos</h3>
        </div>

        <div class="card-body">
            <div>
                <a href="{{ route('product.create') }}" type="button" class="btn btn-primary" style="width:80px;">Novo</a>
            </div>
            <br>
            <table class="table table-bordered table-striped dataTable dtr-inline" id="product" style="font-size: 13px;">
                <thead>
                    <tr>
                        <th style="width: 5%">Id</th>
                        <th style="width: 15%">Produto</th>
                        <th style="width: 15%">Descrição</th>
                        <th style="width: 10%">Tipo</th>
                        <th style="width: 5%">Quantidade</th>
                        <th style="width: 10%">Preço Unitário</th>
                        <th style="width: 10%">Preço Total</th>
                        <th style="width: 15%">Fornecedor</th>
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

            $('#product').DataTable({
                language: {
                    "url": "{{ asset('js/pt-br.json') }}"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('product.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'Produto'
                    },
                    {
                        data: 'description',
                        name: 'Descrição'
                    },
                    {
                        data: 'type',
                        name: 'Tipo'
                    },
                    {
                        data: 'quantity',
                        name: 'Quantidade'
                    },
                    {
                        data: 'unit_price',
                        name: 'Preço Unitário'
                    },
                    {
                        data: 'total_price',
                        name: 'Preço Unitário'
                    },
                    {
                        data: 'supplier_name',
                        name: 'Fornecedor'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@stop
