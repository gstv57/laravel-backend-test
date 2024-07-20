<x-app-layout>
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header">Cadastro de Categoria</h5>
            <div class="card-body">
                <form method="POST" action="{{ route('categorias.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="nome" class="col-form-label">Nome</label>
                        <input id="nome" name="nome" type="text" class="form-control">
                        @error('nome')
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
