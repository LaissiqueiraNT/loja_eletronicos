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

                @if (isset($request->id))
                    <form method="post" action="{{ route('request.update', ['request' => $request->id]) }}">
                        @csrf
                        @method('PUT')
                @else
                    <form method="post" action="{{ route('request.store') }}">
                        @csrf
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="request">Nome Completo</label>
                        <input type="text" class="form-control" id="request" name="request"
                            value="{{ $request->request ?? old('request') }}">
                        @if ($errors->has('request'))
                            <span style="color: red;">{{ $errors->first('request') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="{{ $request->email ?? old('email') }}">
                        @if ($errors->has('email'))
                            <span style="color: red;">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep"
                            value="{{ $request->cep ?? old('cep') }}">
                        @if ($errors->has('cep'))
                            <span style="color: red;">{{ $errors->first('cep') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="address">Endereço</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $request->address ?? old('address') }}">
                        @if ($errors->has('address'))
                            <span style="color: red;">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="city">Cidade</label>
                        <input type="text" class="form-control" id="city" name="city"
                            value="{{ $request->city ?? old('city') }}">
                        @if ($errors->has('city'))
                            <span style="color: red;">{{ $errors->first('city') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf"
                            value="{{ $request->cpf ?? old('cpf') }}">
                        @if ($errors->has('cpf'))
                            <span style="color: red;">{{ $errors->first('cpf') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="rg">RG</label>
                        <input type="text" class="form-control" id="rg" name="rg"
                            value="{{ $request->rg ?? old('rg') }}">
                        @if ($errors->has('rg'))
                            <span style="color: red;">{{ $errors->first('rg') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="birthdate">Data de Nascimento</label>
                        <input type="date" class="form-control" id="birthdate" name="birthdate"
                            value="{{ $request->birthdate ?? old('birthdate') }}">
                        @if ($errors->has('birthdate'))
                            <span style="color: red;">{{ $errors->first('birthdate') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row"> 
                    <div class="col-md-6">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $request->phone ?? old('phone') }}">
                        @if ($errors->has('phone'))
                            <span style="color: red;">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                
                    <div class="col-md-6">
                        <label>Status</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="0" {{ @$request->is_active == 0 ? 'selected' : '' }}>Inativo</option>
                            <option value="1" {{ @$request->is_active == 1 ? 'selected' : '' }}>Ativo</option>
                        </select>
                        @if ($errors->has('is_active'))
                            <span style="color: red;">{{ $errors->first('is_active') }}</span>
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
             $("#cpf").mask("999.999.999-99");
        });
        
    </script>
@stop