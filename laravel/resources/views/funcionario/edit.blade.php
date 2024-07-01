@include('funcionario.header')

    <div class="container mt-5">
        <h2 class="mb-4">Atualizar Funcionário</h2>

        <!-- Alerta de Erro -->
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulário de Cadastro de Funcionário -->
        <form action="{{ route('funcionario.update', $funcionario->id) }}" method="post">
            @csrf
            @method('PUT') <!-- Adiciona o método PUT para o formulário -->

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" value="{{ $funcionario->nome }}">
            </div>

            <div class="mb-3">
                <label for="cargo" class="form-label">Cargo</label>
                <input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo" value="{{ $funcionario->cargo }}">
            </div>

            <div class="mb-3">
                <label for="salario" class="form-label">Salário</label>
                <input type="number" name="salario" id="salario" class="form-control" placeholder="Salário" value="{{ $funcionario->salario }}">
            </div>

            <button type="submit" class="btn btn-primary">Atualizar Funcionário</button>
        </form>
    </div>

@include('funcionario.footer')