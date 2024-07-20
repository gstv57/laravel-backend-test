<x-app-layout>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <x-errors-session></x-errors-session>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Atualização de Cadastro</h5>
                <form method="POST" action="{{ route('clientes.destroy', $cliente->id) }}">
                @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Excluir</button>
                </form>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nome" class="col-form-label">Nome</label>
                        <input id="nome" name="nome" type="text" class="form-control" value="{{ $cliente->nome }}">
                        @error('nome')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" name="email" type="email" value="{{ $cliente->email }}"
                            class="form-control">
                        @error('email')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefone" class="col-form-label">Telefone</label>
                        <input id="telefone" name="telefone" type="number" class="form-control" value="{{ $cliente->telefone }}">
                        @error('telefone')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="data_de_nascimento">Data de Nascimento</label>
                        <input id="data_de_nascimento" name="data_de_nascimento" type="date" class="form-control" value="{{ $cliente->data_de_nascimento }}">
                        @error('data_de_nascimento')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input id="cpf" name="cpf" type="number" class="form-control" value="{{ $cliente->cpf }}">
                        @error('cpf')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option>Escolha um sexo</option>
                            <option value="m" {{ $cliente->sexo == 'm' ? 'selected' : '' }} >Masculino</option>
                            <option value="f" {{ $cliente->sexo == 'f' ? 'selected' : '' }}>Feminino</option>
                        </select>
                        @error('sexo')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>

                    <button type="submit" class="my-2 btn btn-primary">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
