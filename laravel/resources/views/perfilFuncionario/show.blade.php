@include('funcionario.header')


<div id="message"></div>

<table id="listagem">
        <thead>
            <tr>
                <th>ID</th>
                <th>FUNCIONÁRIO_ID</th>
                <th>IDADE</th>
                <th>ENDEREÇO</th>
                <th>TELEFONE</th>
            </tr>
        </thead>
        <tbody></tbody>
</table>
<div id="cadastro">

</div>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // var menssagemStatus;
        function carregaPerfil(){
            $.ajax({
                url: '{{ route("funcionarioperfil.show", $funcionarioId) }}',
                type: 'GET',
                success: function(response) {
                    console.log(response);
                    let tbody = $('#listagem tbody');
                    tbody.empty();
                    let cadastrarDiv = $('#cadastro')
                    cadastrarDiv.empty();
                    let urlCreate = "{{ route('funcionarioperfil.create', 'xx') }}";
                    let urlEdit = "{{ route('funcionarioperfil.edit', 'xx') }}";
                    let pageCreate = urlCreate.replace("xx", {{ $funcionarioId }});
                    let pageEdit = urlEdit.replace("xx", {{ $funcionarioId }});

                    if (response.message == 'Perfil do funcionário já existe!') {
                        tbody.append(`
                            <tr>
                                <td>${response.funcionarioPerfil.id}</td>
                                <td>${response.funcionarioPerfil.funcionario_id}</td>
                                <td>${response.funcionarioPerfil.idade}</td>
                                <td>${response.funcionarioPerfil.endereco}</td>
                                <td>${response.funcionarioPerfil.telefone}</td>
                                <td><a href="${pageEdit}">EDITAR</td>
                                <td><a class="delete" data-id="${response.funcionarioPerfil.funcionario_id}">EXCLUIR</a></td>
                            </tr>
                        `);
                    } else if (response.message == 'Perfil do funcionário não existe!') {
                        cadastrarDiv.append(`
                            <button><a href="${pageCreate}">CADASTRAR</a></button>
                        `);
                    }
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        }

        carregaPerfil();

        $('#listagem').on('click', '.delete', function(event) {
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