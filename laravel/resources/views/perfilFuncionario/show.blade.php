@include('funcionario.header')

    <div class="container mt-5">
        <div id="message"></div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Perfil do Funcionário</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="https://via.placeholder.com/150" class="rounded-circle img-fluid" alt="Foto do Funcionário">
                    </div>
                    <div class="col-md-8" id="perfilContent"></div>
                </div>
                <div id="cadastro" class="mt-3 text-center"></div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function carregaPerfil() {
                $.ajax({
                    url: '{{ route("funcionarioperfil.show", $funcionarioId) }}',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        let perfilContent = $('#perfilContent');
                        perfilContent.empty();
                        let cadastrarDiv = $('#cadastro');
                        cadastrarDiv.empty();
                        let urlCreate = "{{ route('funcionarioperfil.create', 'xx') }}";
                        let urlEdit = "{{ route('funcionarioperfil.edit', 'xx') }}";
                        let pageCreate = urlCreate.replace("xx", {{ $funcionarioId }});
                        let pageEdit = urlEdit.replace("xx", {{ $funcionarioId }});

                        if (response.message == 'Perfil do funcionário já existe!') {
                            perfilContent.append(`
                                <p class="card-text"><strong>Idade:</strong> ${response.funcionarioPerfil.idade}</p>
                                <p class="card-text"><strong>Endereço:</strong> ${response.funcionarioPerfil.endereco}</p>
                                <p class="card-text"><strong>Telefone:</strong> ${response.funcionarioPerfil.telefone}</p>
                                <a href="${pageEdit}" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger delete" data-id="${response.funcionarioPerfil.funcionario_id}">Excluir</a>
                            `);
                        } else if (response.message == 'Perfil do funcionário não existe!') {
                            cadastrarDiv.append(`
                                <a href="${pageCreate}" class="btn btn-primary">Cadastrar Perfil</a>
                            `);
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            carregaPerfil();

            $('#perfilContent').on('click', '.delete', function(event) {
                event.preventDefault();
                var perfilFuncionarioId = $(this).attr("data-id");
                let urlDestroy = "{{ route("funcionarioperfil.destroy", "xx") }}";
                let excluiPerfilFuncionario = urlDestroy.replace("xx", {{ $funcionarioId }});
                if (confirm('Você tem certeza que deseja deletar este item?')) {
                    $.ajax({
                        url: excluiPerfilFuncionario,
                        type: 'DELETE',
                        success: function(response) {
                            carregaPerfil();
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>

@include('funcionario.footer')