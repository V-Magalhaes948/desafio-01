@include('funcionario.header')

<div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Lista de Funcionários</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="{{ route('funcionario.create') }}" class="btn btn-success">CADASTRAR FUNCIONÁRIO</a>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <table id="listagem" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>CARGO</th>
                            <th>SALÁRIO</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
            
            function carregaLista(){
                $.ajax({
                    url: '{{ route("funcionario.index") }}',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        let tbody = $('#listagem tbody');
                        tbody.empty();

                        $.each(response, function(index, item) {
                            let urlEdit = "{{ route("funcionario.edit", "xx") }}";
                            let urlShowPerfil = "{{ route("funcionarioperfil.show", "xx") }}";
                            let pageEdit = urlEdit.replace("xx", item.id);
                            let pageShowPerfil = urlShowPerfil.replace("xx", item.id);
                            tbody.append(`
                                <tr>
                                    <td>${item.id}</td>
                                    <td>${item.nome}</td>
                                    <td>${item.cargo}</td>
                                    <td>${item.salario}</td>
                                    <td>
                                        <a href="${pageShowPerfil}" class="btn btn-info btn-sm">PERFIL</a>
                                        <a href="${pageEdit}" class="btn btn-warning btn-sm">EDITAR</a>
                                        <a href="#" class="btn btn-danger btn-sm delete" data-id="${item.id}">EXCLUIR</a>
                                    </td>
                                </tr>
                            `);
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
            
            carregaLista();

            $('#listagem').on('click', '.delete', function(event) {
                event.preventDefault();
                var funcionarioId = $(this).attr("data-id");
                let urlEdit = "{{ route("funcionario.destroy", "xx") }}";
                let newStr = urlEdit.replace("xx", funcionarioId);
                if (confirm('Você tem certeza que deseja deletar este item?')) {
                    $.ajax({
                        url: newStr,
                        type: 'DELETE',
                        success: function(response) {
                            carregaLista();
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