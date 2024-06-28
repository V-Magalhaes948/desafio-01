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

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                            </tr>
                        `);
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

@include('funcionario.footer')