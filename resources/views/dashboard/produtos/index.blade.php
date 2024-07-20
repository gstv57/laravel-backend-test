<x-app-layout>
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-6">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <div class="card">
            <h5 class="card-header">Produtos</h5>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" name="search" placeholder="Pesquisar produto"
                               value="{{ old('search', request()->input('search')) }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <a
                                    href="{{ route('produtos.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    #
                                    @if (request('sort') == 'id')
                                        <i
                                            class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a
                                    href="{{ route('produtos.index', array_merge(request()->query(), ['sort' => 'nome', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Nome
                                    @if (request('sort') == 'nome')
                                        <i
                                            class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>

                            <th scope="col">
                                <a
                                    href="{{ route('produtos.index', array_merge(request()->query(), ['sort' => 'descricao', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Descrição
                                    @if (request('sort') == 'descricao')
                                        <i
                                            class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a
                                    href="{{ route('produtos.index', array_merge(request()->query(), ['sort' => 'preco', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Preço
                                    @if (request('sort') == 'preco')
                                        <i
                                            class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>

                            <th scope="col">
                                <a
                                    href="{{ route('produtos.index', array_merge(request()->query(), ['sort' => 'quantidade', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Quantidade
                                    @if (request('sort') == 'quantidade')
                                        <i
                                            class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>

                            <th scope="col">
                                <a
                                    href="{{ route('produtos.index', array_merge(request()->query(), ['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Status
                                    @if (request('sort') == 'status')
                                        <i
                                            class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>

                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produtos as $produto)
                            <tr>
                                <th scope="row">{{ $produto->id }}</th>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>

                                <td>{{ $produto->quantidade }}</td>
                                <td>{{ $produto->status ? 'Ativo' : 'Inativo' }}</td>
                                <td>
                                    <a href="{{ route('produtos.edit', $produto->id) }}">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $produtos->appends($queryString)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-app-layout>
