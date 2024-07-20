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
                    <p><strong>Cliente:</strong> {{ $pedido->cliente->nome }}</p>
                    <p><strong>Status:</strong>
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
                    </p>
                    <p><strong>Data do Pedido:</strong> {{ $pedido->data_pedido_efetuado->format('d-m-Y H:i') }}</p>
                    <p><strong>Total:</strong> R$ {{ $pedido->total_pedido }}</p>
                </div>

                <!-- Itens do Pedido -->
                <div class="mb-4">
                    <h5>Itens do Pedido</h5>
                    <ul class="list-group">
                        @foreach ($pedido->produtos as $produto)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $produto->produto->nome }}</span>
                                <span class="badge bg-primary rounded-pill">
                                    R$ {{ number_format($produto->valor_unitario, 2, ',', '.') }} x
                                    {{ $produto->quantidade }}
                                </span>
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
                            <button type="submit" class="btn btn-primary">Atualizar Status</button>
                        </form>
                    </div>
                    <!-- Botões de Ação -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center">
                            <a class="mr-1 btn btn-primary"
                                href="{{ route('pagamento.create', $pedido->id) }}">Processar Pagamento</a>

                            <!-- Botão Editar Pedido -->
                            <a href="" class="mr-2 btn btn-warning">Editar Pedido</a>

                            <!-- Botão Excluir Pedido -->
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="color: black;"
                                    onclick="return confirm('Tem certeza que deseja excluir este pedido?')">Excluir
                                    Pedido</button>
                            </form>
                        </div>
                    </div>

                    <div class="mb-3">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @elseif (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
