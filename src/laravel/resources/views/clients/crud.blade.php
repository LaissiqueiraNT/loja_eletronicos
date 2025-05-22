@extends('adminlte::page')

@section('title', 'Cadastro de Clientes')

@section('content_header')


@stop

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cadastro de Clientes</h3>
        </div>
        <div class="card-body"s>
            <div class=" form-group">

                @if (isset($client->id))
                    <form method="post" action="{{ route('client.update', ['client' => $client->id]) }}">
                        @csrf
                        @method('PUT')
                    @else
                        <form method="post" action="{{ route('client.store') }}">
                            @csrf
                @endif

                <label for="client">Clientes</label>
                <input type="text" class="form-control" id="client" name="client" placeholder=""
                    value="{{ $client->client ?? old('client') }}">
                @if ($errors->has('client'))
                    <span style="color: red;">
                        {{ $errors->first('client') }}
                    </span>
                @endif
                <br>

                <label>Status</label>
                <select class="form-control" name="is_active" id="is_active">
                    <option value="0" {{ @$client->is_active == 0 ? 'selected' : '' }}>Inativo
                    </option>
                    <option value="1" {{ @$client->is_active == 1 ? 'selected' : '' }}>Ativo
                    </option>
                </select>
                @if ($errors->has('is_active'))
                    <span style="color: red;">
                        {{ $errors->first('is_active') }}
                    </span>
                @endif
                <br>
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="{{ route('client.index') }}" type="button" class="btn btn-secondary">Voltar</a>
        </div>
        </form>

    </div>
@stop

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@stop

@section('js')
    <script src="{{ asset('vendor/jquery/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.maskMoney.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        f

        $(document).ready(function() {

            

        });
    </script>
@stop