<x-app-layout>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Cadastro de Produto</h5>
            <div class="card-body">
                <form method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nome" class="col-form-label">Nome</label>
                        <input id="nome" name="nome" type="text" class="form-control" value="{{ $produto->nome }}">
                        @error('nome')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="descricao">Decrição</label>
                        <input id="descricao" name="descricao" type="text" class="form-control" value="{{ $produto->descricao }}">
                        @error('descricao')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="preco" class="col-form-label">Preço</label>
                        <input id="preco" name="preco" type="number" step="0.01" min="0"
                            class="form-control" placeholder="0.00" value="{{ $produto->preco }}">
                        @error('preco')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantidade">Quantidade</label>
                        <input id="quantidade" name="quantidade" type="number" class="form-control" value="{{ $produto->quantidade }}">
                        @error('quantidade')
                            <li class="parsley-required">{{ $message }}</li>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Escolha um status</option>
                            <option value="1" {{ $produto->status == 1 ? 'selected' : '' }}>Ativo</option>
                            <option value="0" {{ $produto->status == 0 ? 'selected' : '' }}>Inativo</option>
                        </select>
                        @error('status')
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
