<x-app-layout>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Cadastro</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('clientes.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nome" class="col-form-label">Nome</label>
                        <input id="nome" name="nome" type="text" class="form-control">
                        @error('nome')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input id="email" name="email" type="email" placeholder="nome@exemplo.com"
                            class="form-control">
                        @error('email')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="telefone" class="col-form-label">Telefone</label>
                        <input id="telefone" name="telefone" type="number" class="form-control" placeholder="00000000000">
                        @error('telefone')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="data_de_nascimento">Data de Nascimento</label>
                        <input id="data_de_nascimento" name="data_de_nascimento" type="date" class="form-control">
                        @error('data_de_nascimento')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input id="cpf" name="cpf" type="number" class="form-control">
                        @error('cpf')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select class="form-control" id="sexo" name="sexo">
                            <option value="">Escolha um sexo</option>
                            <option value="m">Masculino</option>
                            <option value="f">Feminino</option>
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
