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
                        <label for="description">Descrição</label>
                        <input type="text" class="form-control" id="description" name="description"
                            value="{{ $edit->description ?? old('description') }}">
                        @if ($errors->has('description'))
                            <span style="color: red;">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="cep">Tipo</label>
                        <select class="form-control" name="type" id="type">
                            <option value="">Selecione...</option>
                            <option value="hardware" {{ old('type', @$edit->type) == 'hardware' ? 'selected' : '' }}>
                                Hardware</option>
                            <option value="perifericos" {{ old('type', @$edit->type) == 'perifericos' ? 'selected' : '' }}>
                                Periféricos</option>
                            <option value="acessorios" {{ old('type', @$edit->type) == 'acessorios' ? 'selected' : '' }}>
                                Acessórios</option>
                            <option value="componentes" {{ old('type', @$edit->type) == 'componentes' ? 'selected' : '' }}>
                                Componentes</option>
                            <option value="computadores"
                                {{ old('type', @$edit->type) == 'computadores' ? 'selected' : '' }}>Computadores</option>
                            <option value="notebooks" {{ old('type', @$edit->type) == 'notebooks' ? 'selected' : '' }}>
                                Notebooks</option>
                            <option value="impressoras" {{ old('type', @$edit->type) == 'impressoras' ? 'selected' : '' }}>
                                Impressoras</option>
                            <option value="monitores" {{ old('type', @$edit->type) == 'monitores' ? 'selected' : '' }}>
                                Monitores</option>
                            <option value="redes" {{ old('type', @$edit->type) == 'redes' ? 'selected' : '' }}>Redes
                            </option>
                            <option value="smartphones" {{ old('type', @$edit->type) == 'smartphones' ? 'selected' : '' }}>
                                Smartphones</option>
                            <option value="tablets" {{ old('type', @$edit->type) == 'tablets' ? 'selected' : '' }}>
                                Tablets</option>
                            <option value="games" {{ old('type', @$edit->type) == 'games' ? 'selected' : '' }}>Games
                            </option>
                            <option value="cabos" {{ old('type', @$edit->type) == 'cabos' ? 'selected' : '' }}>Cabos
                            </option>
                            <option value="outros" {{ old('type', @$edit->type) == 'outros' ? 'selected' : '' }}>Outros
                            </option>
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
                        <label for="unit_price">Preço Unitário</label>
                        <input type="text" class="form-control" id="unit_price" name="unit_price"
                            value="{{ $edit->unit_price ?? old('unit_price') }}">
                        @if ($errors->has('unit_price'))
                            <span style="color: red;">{{ $errors->first('unit_price') }}</span>
                        @endif
                    </div>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#unit_price').mask('R$ 00.000,00', {
                    reverse: true
                });
            });
        </script>
    @stop
