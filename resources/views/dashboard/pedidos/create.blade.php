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
                        <form method="get" action="{{ route('pedidos.create') }}">
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
                                    onclick="addProduct({{ $produto->id }}, '{{ $produto->nome }}', {{ $produto->preco }})">
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
                        <form method="POST" action="{{ route('pedidos.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="cliente_id">Cliente</label>
                                @error('cliente_id')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <select class="form-control" id="cliente_id" name="cliente_id" required>
                                    <option selected>Selecione um cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Datas -->
                            <div class="form-group">
                                <label for="data_pedido_entrega">Entrega</label>
                                <input type="datetime-local" class="form-control" id="data_pedido_entrega"
                                    name="data_pedido_entrega">
                            </div>
                            <!-- Produtos Selecionados -->
                            <div id="selected-products">
                                <p id="empty-message" class="text-muted">Nenhum produto selecionado</p>
                            </div>
                            <!-- Submit -->
                            <button type="submit" class="mt-3 btn btn-primary" onclick="saveProductsToLocalStorage()">Cadastrar Pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        let productIndex = 0;

        document.addEventListener('DOMContentLoaded', (event) => {
            loadProductsFromLocalStorage();
        });

        function addProduct(id, nome, preco) {
            const emptyMessage = document.getElementById('empty-message');
            if (emptyMessage) {
                emptyMessage.remove();
            }
            const container = document.getElementById('selected-products');
            const productHtml = `
                <div class="mb-3 product-item card" data-id="${id}" data-nome="${nome}" data-preco="${preco}">
                    <div class="card-body">
                        <button type="button" class="close" aria-label="Close" onclick="removeProduct(this)">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="card-title">${nome}</h5>
                        <div class="form-group">
                            <label for="quantidade_${productIndex}">Quantidade</label>
                            <input type="number" class="form-control" id="quantidade_${productIndex}" name="produtos[${productIndex}][quantidade]" value="1" required>
                        </div>
                        <div class="form-group">
                            <label for="valor_unitario_${productIndex}">Valor Unitário</label>
                            <input type="number" step="0.01" class="form-control" id="valor_unitario_${productIndex}" name="produtos[${productIndex}][valor_unitario]" value="${preco}" required>
                        </div>
                        <div class="form-group">
                            <label for="desconto_${productIndex}">Desconto</label>
                            <input type="number" step="0.01" class="form-control" id="desconto_${productIndex}" name="produtos[${productIndex}][desconto]">
                        </div>
                        <input type="hidden" name="produtos[${productIndex}][produto_id]" value="${id}">
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', productHtml);
            productIndex++;

        }

        function removeProduct(button) {
            const productItem = button.closest('.product-item');
            productItem.remove();

            const container = document.getElementById('selected-products');
            if (container.children.length === 0) {
                container.innerHTML = '<p id="empty-message" class="text-muted">Nenhum produto selecionado</p>';
            }

            saveProductsToLocalStorage();
        }

        function saveProductsToLocalStorage() {
            const container = document.getElementById('selected-products');
            const products = [];
            container.querySelectorAll('.product-item').forEach((item, index) => {
                const id = item.getAttribute('data-id');
                const nome = item.getAttribute('data-nome');
                const preco = item.getAttribute('data-preco');
                const quantidade = item.querySelector(`[name="produtos[${index}][quantidade]"]`).value;
                const valor_unitario = item.querySelector(`[name="produtos[${index}][valor_unitario]"]`).value;
                const desconto = item.querySelector(`[name="produtos[${index}][desconto]"]`).value;

                products.push({
                    id,
                    nome,
                    preco,
                    quantidade,
                    valor_unitario,
                    desconto
                });
            });

            localStorage.setItem('carrinho', JSON.stringify(products));
        }

        function loadProductsFromLocalStorage() {
            const products = JSON.parse(localStorage.getItem('carrinho')) || [];
            products.forEach((product) => {
                addProduct(product.id, product.nome, product.preco);
                const container = document.getElementById('selected-products');
                const lastProduct = container.querySelector('.product-item:last-child');

                const quantidadeInput = lastProduct.querySelector(
                    `[name="produtos[${productIndex - 1}][quantidade]"]`);
                quantidadeInput.value = product.quantidade;

                const valorUnitarioInput = lastProduct.querySelector(
                    `[name="produtos[${productIndex - 1}][valor_unitario]"]`);
                valorUnitarioInput.value = product.valor_unitario;

                const descontoInput = lastProduct.querySelector(`[name="produtos[${productIndex - 1}][desconto]"]`);
                descontoInput.value = product.desconto;
            });
        }
    </script>

</x-app-layout>
