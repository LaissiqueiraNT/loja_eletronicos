@extends('adminlte::page')

@section('title', 'Cadastro de Produtos')

@section('content_header')
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Produtos</h3>
        </div>
        <div class="card-body">
            <div class="form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('product.update', ['product' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('product.store') }}">
                            @csrf
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Produto</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $edit->name ?? old('name') }}">
                        @if ($errors->has('name'))
                            <span style="color: red;">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="descripition">Descrição</label>
                        <input type="text" class="form-control" id="descripition" name="descripition"
                            value="{{ $edit->descripition ?? old('descripition') }}">
                        @if ($errors->has('descripition'))
                            <span style="color: red;">{{ $errors->first('descripition') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="cep">Tipo</label>
                        <select class="form-control" name="type" id="type">
                            <option value="0" {{ @$edit->hadware == 0 ? 'selected' : '' }}>Hadware</option>
                            <option value="1" {{ @$edit->peripherals == 1 ? 'selected' : '' }}>Periféricos</option>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for="quantity">Quantidade</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0"
                            value="{{ $edit->quantity ?? old('quantity') }}">
                        @if ($errors->has('quantity'))
                            <span style="color: red;">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="price">Preço</label>
                        <input type="text" class="form-control" id="price" name="price"
                            value="{{ $edit->price ?? old('price') }}">
                        @if ($errors->has('price'))
                            <span style="color: red;">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="brand">Marca</label>
                        <input type="text" class="form-control" id="brand" name="brand"
                            value="{{ $edit->brand ?? old('brand') }}">
                        @if ($errors->has('brand'))
                            <span style="color: red;">{{ $errors->first('brand') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Fornecedor</label>
                        <select class="form-control" name="supplier_id" id="supplier_id">
                            <option value="">Selecione...</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"
                                    {{ isset($edit->supplier_id) && $edit->supplier_id == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('supplier_id'))
                            <span style="color: red;">{{ $errors->first('supplier_id') }}</span>
                        @endif
                    </div>
                </div>

                <br>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('product.index') }}" type="button" class="btn btn-secondary">Voltar</a>
                </div>
                </form>
            </div>
        </div>
    @stop

    @section('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stop

    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskMoney/3.0.2/jquery.maskMoney.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#price').maskMoney({
                    prefix: 'R$ ',
                    allowNegative: false,
                    thousands: '.',
                    decimal: ',',
                    affixesStay: false
                });
            });
        </script>
    @stop
