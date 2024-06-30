@include('funcionario.header')

<form action="{{ route('funcionarioperfil.store', $funcionarioId) }}" method="post">
    @csrf
    <input type="number" name="idade" placeholder="Idade"><br>
    <input type="text" name="endereco" placeholder="Endereço"><br>
    <input type="text" name="telefone" placeholder="Telefone"><br>
    <button type="submit">Criar Perfil</button>
</form>

@if (session('message'))
    <div class="alert alert-danger">
        {{ session('message') }}
    </div>
@endif


@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif



@include('funcionario.footer')