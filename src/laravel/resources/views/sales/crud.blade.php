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
                        <label for="client_id">Cliente*</label>
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
                        <label for="employee_id">Funcionário*</label>
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
                    <div class="col-md-6">
                        <label for="sale_date">Data da Venda*</label>
                        <input type="date" class="form-control" id="sale_date" name="sale_date"
                            value="{{ $sale->sale_date ?? old('sale_date') }}">
                        @if ($errors->has('sale_date'))
                            <span style="color: red;">{{ $errors->first('sale_date') }}</span>
                        @endif
                    </div>

                    <div class="col-md-6">
                        <label for="total_price">Preço Total</label>
                        <input type="text" class="form-control" id="total_price" name="total_price"
                            value="{{ $sale->total_price ?? old('total_price') }}" readonly>
                        @if ($errors->has('total_price'))
                            <span style="color: red;">{{ $errors->first('total_price') }}</span>
                        @endif
                    </div>

                </div>
                <br>
                <div class="row">


                    <div class="col-md-6">
                        <label for="payment_method">Método de Pagamento*</label>
                        <select class="form-control" name="payment_method" id="payment_method">
                            <option value="">Selecione...</option>
                            <option value="dinheiro" {{ @$sale->payment_method == 'dinheiro' ? 'selected' : '' }}>
                                Dinheiro
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


                    <br>
                    <div class="col-md-6">
                        <label for="status">Status*</label>
                        <select class="form-control" name="status" id="status">
                            <option value="Pendente" {{ @$sale->status == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="Pago" {{ @$sale->status == 'Pago' ? 'selected' : '' }}>Pago</option>
                            <option value="Cancelado" {{ @$sale->status == 'Cancelado' ? 'selected' : '' }}>Cancelado
                            </option>
                        </select>
                        @if ($errors->has('status'))
                            <span style="color: red;">{{ $errors->first('status') }}</span>
                        @endif

                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-md-6">
                        <label for="products">Produtos*</label>
                        <select class="form-control" name="products" id="products">
                            <option value="">Selecione um produto</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="col-md-6">
                        <label for="quantity">Quantidade*</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" min="0"
                            value="{{ $edit->quantity ?? old('quantity') }}">
                        @if ($errors->has('quantity'))
                            <span style="color: red;">{{ $errors->first('quantity') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="submit" name="action" value="newRegister" class="btn btn-success">Registrar e cadastrar
                novo</button>
            <a href="{{ route('sale.index') }}" type="button" class="btn btn-secondary">Voltar</a>
            {{-- <button type="submit" name="action" value="newRegister" class="btn btn-primary">Registrar e cadastrar um novo</button> --}}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#total_price').mask('R$ 000.000.000,00', {
                reverse: true
            });
        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });
        $('form').on('submit', function(e) {
            e.preventDefault();

            if (
                $('#client_id').val().trim() === "" ||
                $('#employee_id').val().trim() === "" ||
                $('#sale_date').val().trim() === "" ||
                $('#payment_method').val().trim() === "" ||
                $('#status').val().trim() === "" ||
                $('#products').val().trim() === "" ||
                $('#quantity').val().trim() === ""
            ) {
                Swal.fire({
                    icon: "error",
                    title: "Preencha os campos obrigatórios!",
                    text: "Todos são obrigatórios.",
                });
                return;
            }
            this.submit();
        });
        $(document).ready(function() {
            // Mapeia os preços dos produtos
            let productPrices = {
                @foreach ($products as $product)
                    "{{ $product->id }}": {{ $product->unit_price }},
                @endforeach
            };

            // Torna o campo somente leitura
            $('#total_price').prop('readonly', true);

            function updateTotalPrice() {
                let productId = $('#products').val();
                let quantity = parseInt($('#quantity').val()) || 0;
                let unitPrice = productPrices[productId] || 0;
                let total = unitPrice * quantity;
                // Formata para moeda brasileira
                $('#total_price').val(total.toLocaleString('pt-BR', {
                    style: 'currency',
                    currency: 'BRL'
                }));
            }

            $('#products, #quantity').on('change keyup', updateTotalPrice);

            // Inicializa ao carregar
            updateTotalPrice();
        });
    </script>
@stop
