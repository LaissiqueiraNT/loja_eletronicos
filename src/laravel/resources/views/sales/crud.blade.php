@extends('adminlte::page')

@section('title', 'Cadastro de Funcionários')

@section('content_header')
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Funcionários</h3>
        </div>
        <div class="card-body">
            <div class="form-group">

                @if (isset($sale->id))
                    <form method="post" action="{{ route('sale.update', ['sale' => $sale->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('sale.store') }}">
                            @csrf
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="client_id">Cliente</label>
                        <select class="form-control" name="client_id" id="client_id">
                            <option value="">Selecione...</option>
                            @foreach ($clients as $client)
                                <option value="{{ $client->id }}"
                                    {{ isset($sale->client_id) && $sale->client_id == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('client_id'))
                            <span style="color: red;">{{ $errors->first('client_id') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="employee_id">Funcionário</label>
                        <select class="form-control" name="employee_id" id="employee_id">
                            <option value="">Selecione...</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ isset($sale->employee_id) && $sale->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('employee_id'))
                            <span style="color: red;">{{ $errors->first('employee_id') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label for="sale_date">Data da Venda</label>
                        <input type="date" class="form-control" id="sale_date" name="sale_date"
                            value="{{ $sale->sale_date ?? old('sale_date') }}">
                        @if ($errors->has('sale_date'))
                            <span style="color: red;">{{ $errors->first('sale_date') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="total_price">Preço Total</label>
                        <input type="text" class="form-control" id="total_price" name="total_price"
                            value="{{ $sale->total_price ?? old('total_price') }}">
                        @if ($errors->has('total_price'))
                            <span style="color: red;">{{ $errors->first('total_price') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="payment_method">Método de Pagamento</label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            <option value="">Selecione...</option>
                            <option value="dinheiro" {{ @$sale->payment_method == 'dinheiro' ? 'selected' : '' }}>Dinheiro
                            </option>
                            <option value="cartao" {{ @$sale->payment_method == 'cartao' ? 'selected' : '' }}>Cartão
                            </option>
                            <option value="pix" {{ @$sale->payment_method == 'pix' ? 'selected' : '' }}>Pix</option>
                            <option value="boleto" {{ @$sale->payment_method == 'boleto' ? 'selected' : '' }}>Boleto
                            </option>
                        </select>
                        @if ($errors->has('payment_method'))
                            <span style="color: red;">{{ $errors->first('payment_method') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="status">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="aberta" {{ @$sale->status == 'aberta' ? 'selected' : '' }}>Aberta</option>
                            <option value="paga" {{ @$sale->status == 'paga' ? 'selected' : '' }}>Paga</option>
                            <option value="cancelada" {{ @$sale->status == 'cancelada' ? 'selected' : '' }}>Cancelada
                            </option>
                        </select>
                        @if ($errors->has('status'))
                            <span style="color: red;">{{ $errors->first('status') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <br>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Registrar</button>
                <a href="{{ route('sale.index') }}" type="button" class="btn btn-secondary">Voltar</a>
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
            $('#total_price').maskMoney({
                prefix: 'R$ ',
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: false
            });
        });
        
        
    </script>
@stop
