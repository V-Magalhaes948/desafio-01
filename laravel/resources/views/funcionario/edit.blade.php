@include('funcionario.header')

    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Atualizar Funcionário</h5>
            </div>
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('funcionario.update', $funcionario->id) }}" method="post">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" placeholder="Nome" value="{{ $funcionario->nome }}">
                    </div>

                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <input type="text" name="cargo" id="cargo" class="form-control" placeholder="Cargo" value="{{ $funcionario->cargo }}">
                    </div>

                    <div class="mb-3">
                        <label for="salario" class="form-label">Salário</label>
                        <input type="number" name="salario" id="salario" class="form-control" placeholder="Salário" value="{{ $funcionario->salario }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Atualizar Funcionário</button>
                </form>
            </div>
        </div>
    </div>

@include('funcionario.footer')