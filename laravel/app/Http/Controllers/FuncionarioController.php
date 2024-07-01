<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Validator;

class FuncionarioController extends Controller
{
    public function create()
    {
        return view('funcionario.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
        ]);

        try {
            $sql = "INSERT INTO funcionario (nome, cargo, salario, created_at, updated_at) VALUES (?, ?, ?, ?, ?)";

            DB::insert($sql, [
                $request->nome,
                $request->cargo,
                $request->salario,
                now(),
                now(),
            ]);

            return redirect()->route('funcionario.index')->with('success', 'Funcionário cadastrado com sucesso!');
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar o funcionário!'], 500);
        }
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sql = "SELECT * FROM funcionario";
            $funcionarios = DB::select($sql);
            return response()->json($funcionarios);
        }

        return view('funcionario.index');
    }

    public function edit(Request $request, $id)
    {
        $sql = "SELECT * FROM funcionario WHERE id = ?";

        $funcionario = DB::select($sql, [
            $id
        ]);

        if (!$funcionario) {
            return redirect()->route('funcionario.index', $id)
            ->with('error', 'Erro de validação: Funcionário não existe');
        }

        return view('funcionario.edit', [
            'funcionario' => $funcionario[0]
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'salario' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('funcionario.edit', $id)
            ->with('error', 'Erro de validação: Altere um campo ou não deixe-o o vazio.');
        }

        $sql = "UPDATE funcionario SET nome = ?, cargo = ?, salario = ?, updated_at = ? WHERE id = ?";
        
        DB::update($sql, [
            $request->nome,
            $request->cargo,
            $request->salario,
            now(),
            $id,
        ]);

        return redirect()->route('funcionario.index', ['id' => $id])->with('success', 'Funcionário atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $sql = "DELETE FROM perfil_funcionario WHERE funcionario_id = ?";

        DB::delete($sql, [$id]);

        $sql = "DELETE FROM funcionario WHERE id = ?";
        
        DB::delete($sql, [$id]);

        return response()->json([
            'menssage' => 'Funcionário e Perfil excluídos com sucesso!'. $id
        ]);
    }
}

