<x-app-layout>
    <div class="mx-2 mt-2">
        <div class="row">
            <!-- Catálogo de Produtos -->
            <div class="col-md-6">
                <div class="card">
                    <div class="text-white card-header bg-primary">
                        <h4 class="text-white card-title">Catálogo de Produtos</h4>
                    </div>
                    <div class="card-body">
                        <!-- Campo de Pesquisa -->
                        <form method="get" action="">
                            <div class="mb-4 form-group d-flex align-items-center">
                                <input type="text" id="search_produto" name="search_produto"
                                    class="mr-2 form-control" placeholder="Digite o nome ou descrição do produto">
                                <button type="submit" class="btn-sm btn-primary">Pesquisar</button>
                            </div>
                        </form>
                        <!-- Lista de Produtos -->
                        <div class="list-group">
                            @error('produtos')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            @foreach ($produtos as $produto)
                                <a href="#"
                                    class="list-group-item list-group-item-action d-flex align-items-center"
                                    onclick="adicionarProduto({{ $produto->id }}, '{{ $produto->nome }}', {{ $produto->preco }})">
                                    <img src="{{ $produto->image_url ?? 'https://via.placeholder.com/50' }}"
                                        alt="{{ $produto->nome }}" class="mr-3 img-thumbnail"
                                        style="width: 50px; height: 50px; object-fit: cover;">
                                    <div class="w-100">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $produto->nome }}</h5>
                                            <small>R$ {{ number_format($produto->preco, 2, ',', '.') }}</small>
                                        </div>
                                        <p class="mb-1">{{ $produto->descricao }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="mt-1">
                            {{ $produtos->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Itens Selecionados -->
            <div class="col-md-6">
                <div class="card">
                    <div class="text-white card-header bg-primary">
                        <h4 class="text-white card-title">Itens do Pedido</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('pedidos.update', $pedido->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                @error('cliente_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <select class="form-control" id="cliente_id" name="cliente_id" required>
                                    <option value="{{ $pedido->cliente->id }}">{{ $pedido->cliente->nome }}</option>
                                </select>
                            </div>
                            <!-- Datas -->
                            <div class="form-group">
                                <label for="data_pedido_entrega">Entrega</label>
                                <input type="datetime-local" class="form-control" id="data_pedido_entrega"
                                    name="data_pedido_entrega"
                                    value="{{ $pedido->data_pedido_entrega ? $pedido->data_pedido_entrega->format('Y-m-d\TH:i') : '' }}">
                            </div>
                            <!-- Produtos Selecionados -->
                            <div id="selected-products">
                                @forelse ($pedido->produtos as $index => $produto)
                                    <div class="mb-3 product-item card" data-id="{{ $produto->produto_id }}"
                                        data-nome="{{ $produto->nome }}" data-preco="{{ $produto->valor_unitario }}">
                                        <div class="card-body">
                                            <button type="button" class="close" aria-label="Close"
                                                onclick="removerProdutoAjax({{ $produto->produto_id }})">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <h5 class="card-title">{{ $produto->produto->nome }}</h5>
                                            <div class="form-group">
                                                <label for="quantidade_{{ $index }}">Quantidade</label>
                                                <input type="number" class="form-control"
                                                    id="quantidade_{{ $index }}"
                                                    name="produtos[{{ $index }}][quantidade]"
                                                    value="{{ $produto->quantidade }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="valor_unitario_{{ $index }}">Valor Unitário</label>
                                                <input type="number" step="0.01" class="form-control"
                                                    id="valor_unitario_{{ $index }}"
                                                    name="produtos[{{ $index }}][valor_unitario]"
                                                    value="{{ $produto->valor_unitario }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="desconto_{{ $index }}">Desconto</label>
                                                <input type="number" step="0.01" class="form-control"
                                                    id="desconto_{{ $index }}"
                                                    name="produtos[{{ $index }}][desconto]"
                                                    value="{{ $produto->desconto }}">
                                            </div>
                                            <input type="hidden" name="produtos[{{ $index }}][produto_id]"
                                                value="{{ $produto->produto_id }}">
                                        </div>
                                    </div>
                                @empty
                                    <p id="empty-message" class="text-muted">Nenhum produto selecionado</p>
                                @endforelse
                            </div>
                            <!-- Submit -->
                            <button type="submit" class="mt-3 btn btn-primary">Atualizar Pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        let indiceProduto = {{ count($pedido->produtos) }};

        // document.addEventListener('DOMContentLoaded', (evento) => {
        //     carregarProdutosDoLocalStorage();
        // });

        function adicionarProduto(id, nome, preco) {
            const mensagemVazia = document.getElementById('empty-message');
            if (mensagemVazia) {
                mensagemVazia.style.display = 'none';
            }

            const container = document.getElementById('selected-products');
            const produtoHtml = `
                <div class="mb-3 item-produto card" data-id="${id}" data-nome="${nome}" data-preco="${preco}">
                    <div class="card-body">
                        <button type="button" class="close" aria-label="Close" onclick="removerProduto(this)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="card-title">${nome}</h5>
                        <div class="form-group">
                            <label for="quantidade_${indiceProduto}">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade_${indiceProduto}" name="produtos[${indiceProduto}][quantidade]" value="1" required>
                        </div>
                        <div class="form-group">
                            <label for="valor_unitario_${indiceProduto}">Valor Unitário</label>
                            <input type="number" step="0.01" class="form-control" id="valor_unitario_${indiceProduto}" name="produtos[${indiceProduto}][valor_unitario]" value="${preco}" required>
                        </div>
                        <div class="form-group">
                            <label for="desconto_${indiceProduto}">Desconto</label>
                            <input type="number" step="0.01" class="form-control" id="desconto_${indiceProduto}" name="produtos[${indiceProduto}][desconto]">
                        </div>
                        <input type="hidden" name="produtos[${indiceProduto}][produto_id]" value="${id}">
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', produtoHtml);
            indiceProduto++;

            salvarProdutosNoLocalStorage();
        }

        function removerProduto(botao) {
            const itemProduto = botao.closest('.item-produto');
            itemProduto.remove();

            atualizarIndicesProdutos();

            const container = document.getElementById('selected-products');
            if (container.children.length === 0) {
                const mensagemVazia = document.getElementById('empty-message');
                if (mensagemVazia) {
                    mensagemVazia.style.display = 'block';
                }
            }

            salvarProdutosNoLocalStorage();
        }

        function removerProdutoAjax(produto_id) {
            Swal.fire({
                title: 'Atenção',
                text: 'Tem certeza que deseja remover este produto do pedido?',
                icon: 'warning',
                iconColor: '#5969FF',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Removendo...',
                        text: 'Por favor, aguarde.',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    $.ajax({
                        url: `/pedidos/editar/{{ $pedido->id }}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            produto_id: produto_id,
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Sucesso!",
                                text: "O produto foi excluído com sucesso do pedido!",
                                icon: "success"
                            });
                            $(`.product-item[data-id=${produto_id}]`).remove();
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: "Aconteceu algo de errado!",
                                text: "Não foi possível remover o produto do pedido, entre em contato com o suporte!",
                                icon: "error"
                            });
                        }
                    });
                }
            })

        }

        function atualizarIndicesProdutos() {
            const container = document.getElementById('selected-products');
            container.querySelectorAll('.item-produto').forEach((item, index) => {
                item.querySelectorAll('input, label').forEach(element => {
                    if (element.name) {
                        element.name = element.name.replace(/\d+/, index);
                    }
                    if (element.id) {
                        element.id = element.id.replace(/\d+/, index);
                    }
                    if (element.htmlFor) {
                        element.htmlFor = element.htmlFor.replace(/\d+/, index);
                    }
                });
            });
            indiceProduto = container.querySelectorAll('.item-produto').length;
        }

        function salvarProdutosNoLocalStorage() {
            const container = document.getElementById('selected-products');
            const produtos = [];
            container.querySelectorAll('.item-produto').forEach((item) => {
                const id = item.getAttribute('data-id');
                const nome = item.getAttribute('data-nome');
                const preco = item.getAttribute('data-preco');
                const quantidade = item.querySelector('input[name$="[quantidade]"]').value;
                const valorUnitario = item.querySelector('input[name$="[valor_unitario]"]').value;
                const desconto = item.querySelector('input[name$="[desconto]"]').value;

                produtos.push({
                    id,
                    nome,
                    preco,
                    quantidade,
                    valorUnitario,
                    desconto
                });
            });
            localStorage.setItem('carrinho', JSON.stringify(produtos));
        }

        // function carregarProdutosDoLocalStorage() {
        //     const produtos = JSON.parse(localStorage.getItem('carrinho')) || [];
        //     produtos.forEach((produto, index) => {
        //         adicionarProduto(produto.id, produto.nome, produto.preco);
        //         const container = document.getElementById('selected-products');
        //         const ultimoProduto = container.querySelector('.item-produto:last-child');

        //         const inputQuantidade = ultimoProduto.querySelector(`[name="produtos[${indiceProduto - 1}][quantidade]"]`);
        //         inputQuantidade.value = produto.quantidade;

        //         const inputValorUnitario = ultimoProduto.querySelector(`[name="produtos[${indiceProduto - 1}][valor_unitario]"]`);
        //         inputValorUnitario.value = produto.valorUnitario;

        //         const inputDesconto = ultimoProduto.querySelector(`[name="produtos[${indiceProduto - 1}][desconto]"]`);
        //         inputDesconto.value = produto.desconto;
        //     });
        // }
    </script>


</x-app-layout>
