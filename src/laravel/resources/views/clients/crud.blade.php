@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')
@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Clientes</h3>
        </div>
        <div class="card-body">
            <div class="form-group">

                @if (isset($edit->id))
                    <form method="post" action="{{ route('client.update', ['client' => $edit->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('client.store') }}">
                            @csrf
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <label for="client">Nome Completo*</label>
                        <input type="text" class="form-control" id="client" name="client"
                            value="{{ $edit->name ?? old('client') }}">
                        @if ($errors->has('client'))
                            <span style="color: red;">{{ $errors->first('client') }}</span>
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
                        <label for="cep">CEP</label>
                        <input type="text" class="form-control" id="cep" name="cep"
                            value="{{ $edit->cep ?? old('cep') }}">
                        @if ($errors->has('cep'))
                            <span style="color: red;">{{ $errors->first('cep') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="address">Endereço</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $edit->address ?? old('address') }}">
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
                            value="{{ $edit->city ?? old('city') }}">
                        @if ($errors->has('city'))
                            <span style="color: red;">{{ $errors->first('city') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="cpf">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf"
                            value="{{ $edit->cpf ?? old('cpf') }}">
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
                            value="{{ $edit->rg ?? old('rg') }}">
                        @if ($errors->has('rg'))
                            <span style="color: red;">{{ $errors->first('rg') }}</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <label for="phone">Telefone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ $edit->phone ?? old('phone') }}">
                        @if ($errors->has('phone'))
                            <span style="color: red;">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <br>
                <div class="card-footer">
                    <button name="submit "type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{ route('client.index') }}" type="button" class="btn btn-secondary">Voltar</a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskMoney/3.0.2/jquery.maskMoney.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            $(document).ready(function() {
                $("#cpf").mask("999.999.999-99");
                $("#cep").mask("99999-999");
                $("#phone").mask("(99) 99999-9999");
                $("#rg").mask("99.999.999-9");

                $('#cep').on('blur', function() {
                    let cep = $('#cep').val().replace(/\D/g, '');
                    if (cep.length === 8) {
                        $.ajax({
                            url: 'https://viacep.com.br/ws/' + cep + '/json/',
                            type: 'GET',
                            dataType: 'json',
                            success: function(data) {
                                if (!data.erro) {
                                    $('#address').val(data.logradouro);
                                    $('#city').val(data.localidade);
                                    // $('#bairro').val(data.bairro);
                                    // $('#uf').val(data.uf);
                                } else {
                                    alert('CEP não encontrado.');
                                }
                            },
                            error: function() {
                                alert('Erro ao buscar o CEP.');
                            }
                        });
                    }
                });
                $('form').on('submit', function(e) {
                    if ($('#client').val().trim() === "") {
                        Swal.fire({
                            icon: "error",
                            title: "Preencha os campos obrigatórios!",
                            text: "Nome é obrigatório.",
                        });
                        e.preventDefault();
                    }

                });
            });
        </script>
    @stop
