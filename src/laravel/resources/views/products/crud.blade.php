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
                        <label for="name">Produto*</label>
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
                        <label for="cep">Tipo*</label>
                        <select class="form-control" name="type" id="type">
                            <option value="">Selecione...</option>
                            <option value="Hardware" {{ old('type', @$edit->type) == 'Hardware' ? 'selected' : '' }}>
                                Hardware</option>
                            <option value="Periféricos" {{ old('type', @$edit->type) == 'Periféricos' ? 'selected' : '' }}>
                                Periféricos</option>
                            <option value="Computadores"
                                {{ old('type', @$edit->type) == 'Computadores' ? 'selected' : '' }}>Computadores</option>
                            <option value="Notebooks" {{ old('type', @$edit->type) == 'Notebooks' ? 'selected' : '' }}>
                                Notebooks</option>
                            <option value="Impressoras" {{ old('type', @$edit->type) == 'Impressoras' ? 'selected' : '' }}>
                                Impressoras</option>
                            <option value="Monitores" {{ old('type', @$edit->type) == 'Monitores' ? 'selected' : '' }}>
                                Monitores</option>
                            <option value="Redes" {{ old('type', @$edit->type) == 'Redes' ? 'selected' : '' }}>Redes
                            </option>
                            <option value="Smartphones" {{ old('type', @$edit->type) == 'Smartphones' ? 'selected' : '' }}>
                                Smartphones</option>
                            <option value="Tablets" {{ old('type', @$edit->type) == 'Tablets' ? 'selected' : '' }}>
                                Tablets</option>
                            <option value="Games" {{ old('type', @$edit->type) == 'Games' ? 'selected' : '' }}>Games
                            </option>
                            <option value="Cabos" {{ old('type', @$edit->type) == 'Cabos' ? 'selected' : '' }}>Cabos
                            </option>
                            <option value="Outros" {{ old('type', @$edit->type) == 'Outros' ? 'selected' : '' }}>Outros
                            </option>
                        </select>

                    </div>
                    <div class="col-md-6">
                        <label for="quantity">Quantidade*</label>
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
                        <label for="unit_price">Preço Unitário*</label>
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
            $('#unit_price').mask('R$ 000.000.000,00', {
                reverse: true
            });

            $('form').on('submit', function(e) {
                e.preventDefault();

                if (
                    $('#name').val().trim() === "" ||
                    $('#type').val().trim() === "" ||
                    $('#quantity').val().trim() === "" ||
                    $('#unit_price').val().trim() === ""
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "Preencha os campos obrigatórios!",
                        text: "Produto, Tipo, Quantidade e Preço Unitário são obrigatórios.",
                    });
                    return;
                }
                this.submit();
            });

            $(document).on('submit', '.form-delete', function(e) {
                e.preventDefault();
                let form = this;
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Deseja realmente excluir este registro?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@stop
