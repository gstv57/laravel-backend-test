<x-app-layout>
    <div class="mx-2 mt-2">
        <div class="card">
            <div class="text-white card-header bg-primary">
                <h4 class="text-white card-title">Lista de Pedidos</h4>
            </div>
            <div class="card-body">
                <x-errors-session></x-errors-session>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Status</th>
                            <th>Data do Pedido</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ $pedido->cliente->nome }}</td>
                                <td><x-status-pedido :status="$pedido->status_do_pedido"></x-status-pedido></td>
                                <td>{{ $pedido->data_pedido_efetuado }}</td>
                                <td>R$ {{ number_format($pedido->total_pedido, 2, ',', '.') }}</td>
                                <td>
                                    @if ($pedido->status_do_pedido !== 'arquivado')
                                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-primary">Mais
                                            detalhes</a>
                                        <form action="{{ route('pedidos.arquivar', $pedido->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning"
                                                onclick="return confirm('Tem certeza que deseja arquivar este pedido?')">Arquivar</button>
                                        </form>
                                    @elseif ($pedido->status_do_pedido == 'arquivado')
                                        <form action="{{ route('pedidos.desarquivar', $pedido->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="text-white btn btn-secondary">Desarquivar</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Nenhum pedido encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">{{ $pedidos->links('pagination::bootstrap-4') }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
