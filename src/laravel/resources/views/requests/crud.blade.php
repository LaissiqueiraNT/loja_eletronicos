@extends('adminlte::page')

@section('title', 'Cadastro de Pedidos')

@section('content_header')
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Pedidos</h3>
        </div>
        <div class="card-body">
            <div class="form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('request.update', ['request' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('request.store') }}">
                            @csrf
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="sale_id">Venda</label>
                        <select class="form-control" name="sale_id" id="sale_id">
                            <option value="">Selecione...</option>
                            @foreach ($sales as $sale)
                                <option value="{{ $sale->id }}"
                                    {{ isset($edit->sale_id) && $edit->sale_id == $sale->id ? 'selected' : '' }}>
                                    {{ $sale->id }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('sale_id'))
                            <span style="color: red;">{{ $errors->first('sale_id') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="product_id">Produto</label>
                        <select class="form-control" name="product_id" id="product_id">
                            <option value="">Selecione...</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    {{ isset($edit->product_id) && $edit->product_id == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('product_id'))
                            <span style="color: red;">{{ $errors->first('product_id') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="quantity">Quantidade</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="1"
                            value="{{ $edit->quantity ?? old('quantity') }}">
                        @if ($errors->has('quantity'))
                            <span style="color: red;">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="unit_price">Preço unitário</label>
                        <input type="text" class="form-control" id="unit_price" name="unit_price"
                            value="{{ $edit->unit_price ?? old('unit_price') }}">
                        @if ($errors->has('unit_price'))
                            <span style="color: red;">{{ $errors->first('unit_price') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="total_price">Preço total</label>
                        <input type="text" class="form-control" id="total_price" name="total_price"
                            value="{{ $edit->total_price ?? old('total_price') }}">
                        @if ($errors->has('total_price'))
                            <span style="color: red;">{{ $errors->first('total_price') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('request.index') }}" type="button" class="btn btn-secondary">Voltar</a>
                </div>
                </form>
            </div>
        </div>
    @stop

    @section('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stop

    @section('js')
        <script src="{{ asset('vendor/jquery/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ asset('vendor/jquery/jquery.maskMoney.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
            $('#unit_price, #total_price').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        });
        </script>
    @stop
