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
                        <label for="name">Nome Completo*</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $edit->name ?? old('name') }}">
                        @if ($errors->has('name'))
                            <span style="color: red;">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email*</label>
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
                        <label for="password">Senha*</label>
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
                        <label for="role_id">Cargo*</label>
                        <select class="form-control" name="role_id" id="role_id">
                            <option value="0" {{ old('role_id', @$edit->role_id) == 0 ? 'selected' : '' }}>Admin
                            </option>
                            <option value="1" {{ old('role_id', @$edit->role_id) == 1 ? 'selected' : '' }}>Funcionário
                            </option>
                        </select>
                        @if ($errors->has('role_id'))
                            <span style="color: red;">{{ $errors->first('role_id') }}</span>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(function() {
                // Máscara CPF (caso use)
                $("#cpf").mask("999.999.999-99");

                // Olho da senha
                $('#eye').on('click', function() {
                    const input = $('#password');
                    const img = $('#open');
                    if (input.attr('type') === 'password') {
                        input.attr('type', 'text');
                        img.attr('src', "{{ asset('vendor/adminlte/dist/img/close.png') }}");
                    } else {
                        input.attr('type', 'password');
                        img.attr('src', "{{ asset('vendor/adminlte/dist/img/open.png') }}");
                    }
                });

                $('form').on('submit', function(e) {
            e.preventDefault();

            // Validação dos campos obrigatórios
            if (
                $('#name').val().trim() === "" ||
                $('#email').val().trim() === "" ||
                $('#password').val().trim() === "" ||
                $('#role_id').val().trim() === ""
            ) {
                Swal.fire({
                    icon: "error",
                    title: "Preencha os campos obrigatórios!",
                    text: "Nome, Email, Senha e Cargo são obrigatórios.",
                });
                return;
            }

            // Validação de e-mail via AJAX
            let email = $('#email').val().trim();
            $.ajax({
                url: "{{ route('employee.checkEmail') }}",
                type: "POST",
                data: {
                    email: email,
                    id: "{{ isset($edit->id) ? $edit->id : '' }}",
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.exists) {
                        Swal.fire({
                            icon: "error",
                            title: "Erro!",
                            text: "Este e-mail já está cadastrado.",
                        });
                    } else {
                        // Se não existe, envia o formulário
                        e.target.submit();
                    }
                }
            });
        });
    });
        </script>
    @stop
