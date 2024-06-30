@include('funcionario.header')

    <!-- Formulário de Cadastro de Funcionário -->
    @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
<form action="{{ route('funcionario.update', $funcionario->id) }}" method="post">
    @csrf
    @method('PUT') <!-- Adiciona o método PUT para o formulário -->
    <input type="text" name="nome" placeholder="Nome" value="{{ $funcionario->nome }}"><br>
    <input type="text" name="cargo" placeholder="Cargo" value="{{ $funcionario->cargo }}"><br>
    <input type="number" name="salario" placeholder="Salário" value="{{ $funcionario->salario }}"><br>
    <button type="submit">Atualizar Funcionário</button>
</form>

@include('funcionario.footer')