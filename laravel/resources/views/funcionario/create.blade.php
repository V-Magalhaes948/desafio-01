@include('funcionario.header')

    <!-- Formulário de Cadastro de Funcionário -->
    <div class="container mt-5">
        <h2>Cadastro de Funcionário</h2>

        <!-- Div para exibir mensagens -->
        <div id="message"></div>

        <form id="funcionarioForm" method="POST">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
            </div>
            <div class="form-group">
                <label for="cargo">Cargo:</label>
                <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo') }}">
            </div>
            <div class="form-group">
                <label for="salario">Salário:</label>
                <input type="number" class="form-control" id="salario" name="salario" value="{{ old('salario') }}">
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#funcionarioForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("funcionario.store") }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Redireciona para a página de listagem de funcionários com a mensagem de sucesso
                        window.location.href = '{{ route("funcionario.index") }};
                    },
                    error: function(response) {
                        var errorHtml;
                        if (response.status === 422) {
                            errorHtml = '<div class="alert alert-danger">Erro de validação: preencha todos os campos corretamente.</div>';
                        } else if (response.status === 500) {
                            errorHtml = '<div class="alert alert-danger">Erro no servidor: tente novamente mais tarde.</div>';
                        }
                        $('#message').html(errorHtml);
                    }
                });
            });
        });
    </script>

@include('funcionario.footer')