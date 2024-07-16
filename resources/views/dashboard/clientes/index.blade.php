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
            <h5 class="card-header">Clientes</h5>
            <div class="card-body">
                <form method="GET" action="{{ route('clientes.index') }}">
                    <div class="mb-3 input-group">
                        <input type="text" class="form-control" name="search" placeholder="Pesquisar cliente" value="{{ request()->input('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'id', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    #
                                    @if(request('sort') == 'id')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'nome', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Nome
                                    @if(request('sort') == 'nome')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'email', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    E-mail
                                    @if(request('sort') == 'email')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'telefone', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Telefone
                                    @if(request('sort') == 'telefone')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'data_de_nascimento', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Dt Nascimento
                                    @if(request('sort') == 'data_de_nascimento')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'cpf', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    CPF
                                    @if(request('sort') == 'cpf')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'sexo', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Sexo
                                    @if(request('sort') == 'sexo')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">
                                <a href="{{ route('clientes.index', array_merge(request()->query(), ['sort' => 'status', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc'])) }}">
                                    Status
                                    @if(request('sort') == 'status')
                                        <i class="fas fa-sort{{ request('direction') === 'asc' ? '-up' : '-down' }}"></i>
                                    @endif
                                </a>
                            </th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <th scope="row">{{ $cliente->id }}</th>
                                <td>{{ $cliente->nome }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->telefone }}</td>
                                <td>{{ $cliente->data_de_nascimento }}</td>
                                <td>{{ $cliente->cpf }}</td>
                                <td>{{ $cliente->sexo }}</td>
                                <td>{{ $cliente->status ? 'ativo' : 'inativo' }}</td>
                                <td>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}">
                                        <i class="fas fa-user"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $clientes->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</x-app-layout>
