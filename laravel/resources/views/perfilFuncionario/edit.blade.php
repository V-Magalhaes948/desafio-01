@include('funcionario.header')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Edição do Perfil do Funcionário</h5>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('funcionarioperfil.update', $funcionarioPerfil->funcionario_id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="idade" class="form-label">Idade</label>
                        <input type="number" class="form-control" id="idade" name="idade" placeholder="Idade" value="{{ $funcionarioPerfil->idade }}">
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Endereço" value="{{ $funcionarioPerfil->endereco }}">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="{{ $funcionarioPerfil->telefone }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Atualizar Funcionário</button>
                </form>
            </div>
        </div>
    </div>

@include('funcionario.footer')