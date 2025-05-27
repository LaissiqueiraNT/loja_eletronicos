@extends('adminlte::page')

@section('title', 'Cadastro de Fornecedores')

@section('content_header')
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Fornecedores</h3>
        </div>
        <div class="card-body">
            <div class="form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('supplier.update', ['supplier' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                @else
                    <form method="post" action="{{ route('supplier.store') }}">
                        @csrf
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Empresa</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $edit->name ?? old('name') }}">
                        @if ($errors->has('name'))
                            <span style="color: red;">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $edit->email ?? old('email') }}">
                        @if ($errors->has('email'))
                            <span style="color: red;">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $edit->phone ?? old('phone') }}">
                        @if ($errors->has('phone'))
                            <span style="color: red;">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="cnpj">CNPJ</label>
                        <input type="text" class="form-control" id="cnpj" name="cnpj"
                            value="{{ $edit->cnpj ?? old('cnpj') }}">
                        @if ($errors->has('cnpj'))
                            <span style="color: red;">{{ $errors->first('cnpj') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="address">Endereço</label>
                        <input type="text" class="form-control" id="address" placeholder="CEP, Cidade(Estado), Bairro, Rua" name="address"
                            value="{{ $edit->address ?? old('address') }}">
                        @if ($errors->has('address'))
                            <span style="color: red;">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label>Status</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="0" {{ old('is_active', @$edit->is_active) == 0 ? 'selected' : '' }}>Inativo</option>
                            <option value="1" {{ old('is_active', @$edit->is_active) == 1 ? 'selected' : '' }}>Ativo</option>
                        </select>
                        @if ($errors->has('is_active'))
                            <span style="color: red;">{{ $errors->first('is_active') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('supplier.index') }}" type="button" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
             $("#cnpj").mask("99.999.999/9999-99");
             $("#phone").mask("(99) 99999-9999");
        });
    </script>
@stop