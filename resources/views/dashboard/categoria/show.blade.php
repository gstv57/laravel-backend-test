<x-app-layout>
    <div class="mx-2 my-2 mt-2">
        <!-- Categoria Details -->
        <x-errors-session></x-errors-session>
        <div class="mb-4 card">
            <div class="card-header">
                Detalhes da Categoria
            </div>
            <div class="card-body">
                <h5 class="card-title">Nome da Categoria: <span id="categoria-nome">{{ $categoria->nome }}</span></h5>
                <p class="card-text">Descrição da Categoria: <span id="categoria-descricao">Produtos eletrônicos
                        diversos</span></p>
                <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#addProductModal">Adicionar Produto</button>
            </div>
        </div>

        <!-- Produtos List -->
        <div class="card">
            <div class="card-header">
                Produtos
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="product-list">
                        @forelse ($categoria->produtos as $produto)
                            <tr>
                                <th scope="row">{{ $produto->id }}</th>
                                <td>
                                    @if($produto->foto)
                                        <img src="{{ asset('storage/' . $produto->foto) }}" alt="{{ $produto->nome }}" class="img-thumbnail" style="max-width: 100px;">
                                    @else
                                        <img src="{{ asset('images/default-product.png') }}" alt="produto" class="img-thumbnail" style="max-width: 100px;">
                                    @endif
                                </td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('produtos.edit', $produto->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                    <form action="{{ route('produtos.categoria.attachless', ['id'=>$produto->id, 'categoria' => $categoria->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remover</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Sem produtos cadastrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


                {{-- <button id="" class="my-2 btn btn-danger">Remover Selecionados</button> --}}
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Adicionar Produto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="cadastro_categoria_produto" method="POST"
                        action="{{ route('produtos.categoria.attach', $categoria->id) }}">
                        @csrf
                        <div class="form-group">
                            <label for="produtos">Nome do Produto</label>
                            <select class="produtos" id="produtos" name="produtos[]" multiple="multiple"
                                style="width: 75%"></select>
                        </div>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('.produtos').select2({
                placeholder: 'Selecione um produto',
                allowClear: true,
            });

            $('#produtos').select2({
                ajax: {
                    url: "{{ route('produtos.ajax.search') }}",
                    type: "post",
                    delay: 250,
                    dataType: 'json',

                    data: function(params) {
                        return {
                            name: params.term,
                            "_token": "{{ csrf_token() }}"
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.nome,
                                }
                            })
                        };
                    }
                },
                language: {
                    noResults: function() {
                        return "Nenhum resultado encontrado";
                    },

                }
            });


            let productList = $('#product-list');
            // Add Product
            $('#addProductForm').on('submit', function(e) {
                e.preventDefault();
                let productName = $('#product-name').val();
                let productDescription = $('#product-description').val();
                let productPrice = $('#product-price').val();

                let newRow = `<tr>
                    <td><input type="checkbox" class="product-checkbox"></td>
                    <td>${productName}</td>
                    <td>${productDescription}</td>
                    <td>${productPrice}</td>
                    <td>
                        <button class="btn btn-sm btn-danger remove-product">Remover</button>
                    </td>
                </tr>`;

                productList.append(newRow);
                $('#addProductModal').modal('hide');
                $('#addProductForm')[0].reset();
            });

            // Remove Single Product
            $(document).on('click', '.remove-product', function() {
                $(this).closest('tr').remove();
            });

            // Remove Selected Products
            $('#removeSelected').on('click', function() {
                $('.product-checkbox:checked').closest('tr').remove();
            });
        });
    </script>
</x-app-layout>
