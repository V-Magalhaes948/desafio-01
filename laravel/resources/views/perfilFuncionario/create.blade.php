@include('funcionario.header')

<form action="{{ route('funcionarioperfil.store', $funcionarioId) }}" method="post">
    @csrf
    <input type="number" name="idade" placeholder="Idade"><br>
    <input type="text" name="endereco" placeholder="Endereço"><br>
    <input type="text" name="telefone" placeholder="Telefone"><br>
    <button type="submit">Criar Perfil</button>
</form>

@include('funcionario.footer')