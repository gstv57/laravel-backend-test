<x-app-layout>
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-6">
        <x-errors-session></x-errors-session>
        <div class="card">
            <h5 class="card-header">Categorias</h5>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" name="search" placeholder="Pesquisar categoria" value="{{ old('search', request()->input('search')) }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <a href="{{ route('categorias.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    #
                                    @if(request('sort') == 'id')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('categorias.index', array_merge(request()->query(), ['sort' => 'nome', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Nome
                                    @if(request('sort') == 'nome')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>

                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <th scope="row">{{ $categoria->id }}</th>
                                <td>{{ $categoria->nome }}</td>
                                <td>
                                    <a href="{{ route('categorias.show', $categoria->id) }}">
                                        <i class="fas fa-cog"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categorias->appends($queryString)->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-app-layout>
