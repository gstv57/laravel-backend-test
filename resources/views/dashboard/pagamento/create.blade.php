<x-app-layout>
    <div class="mx-2 mt-2">
        <div class="card">
            <!-- Cabeçalho do Card -->
            <div class="text-white card-header bg-primary">
                <h4 class="text-white card-title">Processar Pagamento</h4>
            </div>

            <!-- Corpo do Card -->
            <div class="card-body">
                <!-- Dados do Comprador -->
                <section class="mb-2">
                    <h5>Dados do Comprador</h5>
                    <dl class="row">
                        <dt class="col-sm-3">Nome:</dt>
                        <dd class="col-sm-9">{{ $pedido->cliente->nome }}</dd>

                        <dt class="col-sm-3">Email:</dt>
                        <dd class="col-sm-9">{{ $pedido->cliente->email }}</dd>

                        <dt class="col-sm-3">Telefone:</dt>
                        <dd class="col-sm-9">{{ $pedido->cliente->telefone }}</dd>

                        <dt class="col-sm-3">Endereço:</dt>
                        <dd class="col-sm-9">{{ $pedido->cliente->endereco }}</dd>
                    </dl>
                </section>

                <!-- Dados do Pedido -->
                <section class="mb-2">
                    <h5>Dados do Pedido</h5>
                    <dl class="row">
                        <dt class="col-sm-3">Número do Pedido:</dt>
                        <dd class="col-sm-9">#{{ $pedido->id }}</dd>

                        <dt class="col-sm-3">Data do Pedido:</dt>
                        <dd class="col-sm-9">{{ $pedido->data_pedido_efetuado->format('d-m-Y H:i') }}</dd>

                        <dt class="col-sm-3">Status:</dt>
                        <dd class="col-sm-9">
                            @switch($pedido->status_do_pedido)
                                @case('pendente')
                                    <span class="badge bg-warning text-dark">Pendente</span>
                                    @break
                                @case('processando')
                                    <span class="badge bg-info text-dark">Processando</span>
                                    @break
                                @case('enviado')
                                    <span class="text-white badge bg-primary">Enviado</span>
                                    @break
                                @case('entregue')
                                    <span class="text-white badge bg-success">Entregue</span>
                                    @break
                                @case('cancelado')
                                    <span class="text-white badge bg-danger">Cancelado</span>
                                    @break
                            @endswitch
                        </dd>
                    </dl>
                </section>

                <!-- Formas de PagamentoCriado -->
                <section class="mb-2">
                    <h5>Formas de Pagamento</h5>
                    <form method="POST" action="{{ route('pagamento.store', $pedido->id) }}" id="formas_de_pagamento">
                        @csrf
                        <div class="form-group">
                            <label for="forma_de_pagamento">Selecione a Forma de Pagamento:</label>
                            <select class="form-control" id="forma_de_pagamento" name="forma_de_pagamento" required>
                                <option selected>Selecione uma opção</option>
                                <option value="cartao_credito">Cartão de Crédito</option>
                            </select>
                        </div>
                    </form>
                </section>

                <!-- Valores -->
                <section class="mb-2">
                    <dl class="row">
                        <dt class="col-sm-3">Subtotal:</dt>
                        <dd class="col-sm-9">
                            R$ {{ number_format($pedido->sub_total ,2, ',','.') }}
                        </dd>
                        <dt class="col-sm-3">Desconto:</dt>
                        <dd class="col-sm-9">
                            R$ {{ number_format($pedido->desconto ,2, ',','.') }}
                        </dd>

                        <dt class="col-sm-3">Total:</dt>
                        <dd class="col-sm-9">
                            R$ {{ number_format($pedido->total_pedido ,2, ',','.') }}
                        </dd>
                    </dl>
                </section>


                <!-- Datas -->
                <section class="mb-2">
                    <dl class="row">
                        <dt class="col-sm-3">Data de Emissão:</dt>
                        <dd class="col-sm-9">{{ $pedido->data_pedido_efetuado->format('d/m/Y H:i') }}</dd>

                        <dt class="col-sm-3">Data de Vencimento:</dt>
                        <dd class="col-sm-9">{{ $pedido->data_pedido_vencimento->format('d/m/Y H:i') }}</dd>
                    </dl>
                </section>

                <!-- Assinaturas -->
                <section class="mb-2">
                    <h5>Assinaturas</h5>
                    <div class="row">
                        <div class="text-center col-sm-6">
                            <p>_____________________________</p>
                            <p>Assinatura do Comprador</p>
                        </div>
                        <div class="text-center col-sm-6">
                            <p>_____________________________</p>
                            <p>Assinatura do Vendedor</p>
                        </div>
                    </div>
                </section>

                <!-- Botões de Ação -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="mr-2 btn btn-primary" onclick="document.getElementById('formas_de_pagamento').submit();">Enviar Pagamento</button>
                    <button type="button" class="btn btn-secondary" >Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
