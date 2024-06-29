<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Formulário de Cadastro de Funcionário -->
<form action="{{ route('funcionario.update', $funcionario->id) }}" method="post">
    @csrf
    @method('PUT') <!-- Adiciona o método PUT para o formulário -->
    <input type="text" name="nome" placeholder="Nome" value="{{ $funcionario->nome }}"><br>
    <input type="text" name="cargo" placeholder="Cargo" value="{{ $funcionario->cargo }}"><br>
    <input type="number" name="salario" placeholder="Salário" value="{{ $funcionario->salario }}"><br>
    <button type="submit">Atualizar Funcionário</button>
</form>
    @dump($funcionario)
</body>
</html>