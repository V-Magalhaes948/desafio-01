@include('funcionario.header')

    <!-- Formulário de Cadastro de Funcionário -->
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Cadastro de Funcionário</h5>
            </div>
            <div class="card-body">
                <div id="message"></div>

                <form id="funcionarioForm" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}">
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo:</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" value="{{ old('cargo') }}">
                    </div>
                    <div class="mb-3">
                        <label for="salario" class="form-label">Salário:</label>
                        <input type="number" class="form-control" id="salario" name="salario" value="{{ old('salario') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
                </form>
            </div>
        </div>
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
                        window.location.href = '{{ route("funcionario.index") }}';
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