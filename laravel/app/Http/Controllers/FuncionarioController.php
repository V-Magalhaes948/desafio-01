<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;

class FuncionarioController extends Controller
{
    public function create()
    {
        return view('funcionario.cadastro');
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
        ]);

        $sql = "INSERT INTO funcionarios (nome, cargo, salario, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";

        DB::insert($sql, [
            $request->nome,
            $request->cargo,
            $request->salario,
            now(),
            now(),
        ]);

        // Redireciona de volta para o formulário com uma mensagem de sucesso
        return redirect()->route('funcionario.create')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function index($id)
    {
        // Query SQL para buscar um funcionário por ID
        $sql = "SELECT * FROM funcionarios WHERE id = ?";
        
        // Execução da query utilizando o Query Builder do Laravel
        $funcionario = DB::select($sql, [$id]);

        // Verifica se encontrou algum funcionário
        if (empty($funcionario)) {
            return response()->json(['error' => 'Funcionário não encontrado'], 404);
        }

        return response()->json($funcionario[0]);
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados do formulário
        $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
        ]);

        // Query SQL para atualizar os dados do funcionário
        $sql = "UPDATE funcionarios SET nome = ?, cargo = ?, salario = ?, updated_at = ? WHERE id = ?";
        
        // Execução da query utilizando o Query Builder do Laravel
        DB::update($sql, [
            $request->nome,
            $request->cargo,
            $request->salario,
            now(),
            $id,
        ]);

        // Redireciona de volta para a página do funcionário ou retorna uma mensagem de sucesso
        return redirect()->route('funcionario.show', ['id' => $id])->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        // Query SQL para excluir um funcionário
        $sql = "DELETE FROM funcionarios WHERE id = ?";
        
        // Execução da query utilizando o Query Builder do Laravel
        DB::delete($sql, [$id]);

        // Redireciona de volta para a lista de funcionários ou retorna uma mensagem de sucesso
        return redirect()->route('funcionario.index')->with('success', 'Funcionário excluído com sucesso!');
    }
}

