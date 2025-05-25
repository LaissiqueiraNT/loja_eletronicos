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

                @if (isset($edit->id))
                    <form method="post" action="{{ route('employee.update', ['employee' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('employee.store') }}">
                            @csrf
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="name">Nome Completo</label>
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
                        <label for="password">Senha</label>
                        <div style="position: relative;">
                            <input type="password" class="form-control" id="password" name="password"
                                value="{{ $edit->password ?? old('password') }}">
                            <button id="eye" type="button"
                                style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); background: none; border: none; padding: 0; cursor: pointer;">
                                <img id="open" src="{{ asset('vendor/adminlte/dist/img/open.png') }}" alt="eye"
                                    style="width: 25px; height: 25px;">
                            </button>
                        </div>
                        @if ($errors->has('password'))
                            <span style="color: red;">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="address">Cargo</label>
                        <select class="form-control" name="role" id="role">
                            <option value="0" {{ @$edit->role == 0 ? 'selected' : '' }}>Admin</option>
                            <option value="1" {{ @$edit->role == 1 ? 'selected' : '' }}>Funcionário</option>
                        </select>
                        @if ($errors->has('role'))
                            <span style="color: red;">{{ $errors->first('role') }}</span>
                        @endif


                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label>Status</label>
                        <select class="form-control" name="is_active" id="is_active">
                            <option value="0" {{ @$edit->is_active == 0 ? 'selected' : '' }}>Inativo</option>
                            <option value="1" {{ @$edit->is_active == 1 ? 'selected' : '' }}>Ativo</option>
                        </select>
                        @if ($errors->has('is_active'))
                            <span style="color: red;">{{ $errors->first('is_active') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('employee.index') }}" type="button" class="btn btn-secondary">Voltar</a>
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

                const button = document.getElementById('eye');
                const input = document.getElementById('password');
                const img = document.getElementById('open');

                if (button && input && img) {
                    button.addEventListener('click', function() {
                        if (input.type === 'password') {
                            input.type = 'text';
                            img.src = "{{ asset('vendor/adminlte/dist/img/close.png') }}";
                        } else {
                            input.type = 'password';
                            img.src = "{{ asset('vendor/adminlte/dist/img/open.png') }}";
                        }
                    });
                } else {
                    console.error('Botão ou input não encontrados.');
                }
            });
        </script>
    @stop
