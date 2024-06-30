@include('funcionario.header')

    <div>
        <h2>Edição do Perfil do Funcionário</h2>

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Div para exibir mensagens -->
        <form action="{{ route('funcionarioperfil.update', $funcionarioPerfil->funcionario_id) }}" method="post">
            @csrf
            @method('PUT') <!-- Adiciona o método PUT para o formulário -->
            <input type="number" name="idade" placeholder="Idade" value="{{ $funcionarioPerfil->idade }}"><br>
            <input type="text" name="endereco" placeholder="Endereco" value="{{ $funcionarioPerfil->endereco }}"><br>
            <input type="text" name="telefone" placeholder="Telefone" value="{{ $funcionarioPerfil->telefone }}"><br>
            <button type="submit">Atualizar Funcionário</button>
        </form>
    </div>




@include('funcionario.footer')