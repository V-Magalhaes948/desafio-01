@include('funcionario.header')

    <table id="listagem">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOME</th>
                <th>CARGO</th>
                <th>SALÁRIO</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
    <button class="delete">TESTE</button>
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
                        //Receber response
                        //Fazer loop para cada item do response
                        //Criar elemento html tr 
                        //Fazer loop para cada coluna (id, nome, cargo, salário)
                        //Criar elemento html td e fazer append na tr
                        //Localizar o tbody dentro da table e fazer o append da tr no tbody
                        // Limpa a tabela
                        let tbody = $('#listagem tbody');
                        tbody.empty();

                        // Adiciona cada linha na tabela
                        $.each(response, function(index, item) {
                            let urlEdit = "{{ route("funcionario.edit", "xx") }}";
                            let newStr = urlEdit.replace("xx", item.id);
                            tbody.append(`
                                <tr>
                                    <td>${item.id}</td>
                                    <td>${item.nome}</td>
                                    <td>${item.cargo}</td>
                                    <td>${item.salario}</td>
                                    <td><a href="${newStr}">EDITAR</a></td>
                                    <td><a class="delete" data-id="${item.id}">EXCLUIR</a></td>
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