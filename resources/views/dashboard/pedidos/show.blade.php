<x-app-layout>
    <div class="mx-2 mt-2">
        <div class="card">
            <div class="text-white card-header bg-primary">
                <h4 class="text-white card-title">Detalhes do Pedido #{{ $pedido->id }}</h4>
            </div>
            <div class="card-body">
                <!-- Detalhes do Pedido -->
                <div class="mb-4">
                    <h5>Informações do Pedido</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong>
                                <x-status-pedido :status="$pedido->status_do_pedido"></x-status-pedido>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Data do Pedido:</strong> {{ $pedido->data_pedido_efetuado->format('d-m-Y H:i') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->total_pedido, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Itens do Pedido -->
                <div class="mb-4">
                    <h5>Itens do Pedido</h5>
                    <ul class="list-group">
                        @foreach ($pedido->produtos as $produto)
                            <li class="list-group-item">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $produto->produto->foto_url }}" alt="Foto do produto"
                                        class="img-thumbnail me-3" style="width: 50px; height: 50px;">
                                    <div class="d-flex flex-column flex-grow-1">
                                        <strong>{{ $produto->produto->nome }}</strong>
                                        <small class="text-muted">
                                            {{ $produto->quantidade }} x R$
                                            {{ number_format($produto->valor_unitario, 2, ',', '.') }}
                                        </small>
                                    </div>
                                    <div class="text-end">
                                        <div class="mb-1">
                                            <span class="text-white badge bg-success rounded-pill">
                                                Total: R$
                                                {{ number_format($produto->valor_unitario * $produto->quantidade, 2, ',', '.') }}
                                            </span>
                                        </div>
                                        <span class="text-white badge bg-danger rounded-pill">
                                            Desconto: R$ {{ number_format($produto->desconto, 2, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Ações -->
                <div class="mb-4">
                    <h5>Ações</h5>

                    <!-- Alterar Status -->
                    <div class="mb-3">
                        <h6>Alterar Status</h6>
                        <form method="POST" action="">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <select class="form-control" id="status_do_pedido" name="status_do_pedido" required>
                                    <option value="pendente"
                                        {{ $pedido->status_do_pedido == 'pendente' ? 'selected' : '' }}>Pendente
                                    </option>
                                    <option value="processando"
                                        {{ $pedido->status_do_pedido == 'processando' ? 'selected' : '' }}>Processando
                                    </option>
                                    <option value="enviado"
                                        {{ $pedido->status_do_pedido == 'enviado' ? 'selected' : '' }}>Enviado</option>
                                    <option value="entregue"
                                        {{ $pedido->status_do_pedido == 'entregue' ? 'selected' : '' }}>Entregue
                                    </option>
                                    <option value="cancelado"
                                        {{ $pedido->status_do_pedido == 'cancelado' ? 'selected' : '' }}>Cancelado
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="mt-2 btn btn-primary">Atualizar Status</button>
                        </form>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="mb-3">
                        <h6>Ações Rápidas</h6>
                        <div class="gap-2 d-grid d-md-block">
                            <a class="mb-2 btn btn-primary me-2"
                                href="{{ route('pagamento.create', $pedido->id) }}">Processar Pagamento</a>

                            <!-- Botão Editar Pedido -->
                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="mb-2 btn btn-warning me-2">Editar
                                Pedido</a>

                            <!-- Botão Excluir Pedido -->
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este pedido?')"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="mb-2 btn btn-danger">Excluir Pedido</button>
                            </form>
                        </div>
                    </div>

                    <!-- Exibição de Erros -->
                    <div class="mb-3">
                        <x-errors-session></x-errors-session>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
