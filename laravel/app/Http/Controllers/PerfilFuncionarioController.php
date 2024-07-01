<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use App\Models\PerfilFuncionario;
use Illuminate\Support\Facades\Validator;

class PerfilFuncionarioController extends Controller
{
    public function create($funcionarioId)
    {
        return view('perfilFuncionario.create', [
            'funcionarioId' => $funcionarioId
        ]);
    }


    public function store(Request $request, $funcionarioId)
    {
        $query = "SELECT id FROM funcionario WHERE id = ?";
        
        $validaFuncionario = DB::select($query, [$funcionarioId]);

        if (!$validaFuncionario) {
            return redirect()->route('funcionarioperfil.create', $funcionarioId)
            ->with('message', 'Erro de validação: Funcionário não existe');

        }
        $validator = Validator::make($request->all(), [
            'idade' => 'required|integer|min:1',
            'endereco' => 'required|string|max:120',
            'telefone' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('funcionarioperfil.create', $funcionarioId)
            ->with('error', 'Erro de validação: Preencha os campos de forma correta');
        }
        
        $sql = "INSERT INTO perfil_funcionario (funcionario_id, idade, endereco, telefone, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";

        DB::insert($sql, [
            $funcionarioId,
            $request-> idade,
            $request-> endereco,
            $request-> telefone,
            now(),
            now(),
        ]);

        return redirect()->route('funcionarioperfil.show', $funcionarioId)
                ->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function show(Request $request, $funcionarioId)
    {
      
        $sql = "SELECT * FROM perfil_funcionario WHERE funcionario_id = ?";

        $confirmaPerfilFuncionario = DB::select($sql, [
            $funcionarioId
        ]);
        
        if ($request->ajax()) {
            if ($confirmaPerfilFuncionario) {
                return response()->json([
                    'message' => 'Perfil do funcionário já existe!',
                    'funcionarioPerfil' => $confirmaPerfilFuncionario[0]
                ]);
            } else {
                return response()->json([
                    'message' => 'Perfil do funcionário não existe!'
                ]);
            }
        }    

        return view('perfilFuncionario.show', [
            'funcionarioId' => $funcionarioId   
        ]);
    }

    public function edit(Request $request, $funcionarioId) 
    {
        
        $sql = "SELECT * FROM perfil_funcionario WHERE funcionario_id = ?";

        $perfilDoFuncionario = DB::select($sql, [
            $funcionarioId  
        ]);

        if (!$perfilDoFuncionario) {
            return redirect()->route('funcionario.index', $funcionarioId)
            ->with('error', 'Erro de validação: Funcionário não existe');
        }
        
        return view('perfilFuncionario.edit', [
            'funcionarioPerfil' => $perfilDoFuncionario[0],
            'funcionarioId' => $funcionarioId
        ]);
    }

    public function update(Request $request, $funcionarioId) 
    {
        $validator = Validator::make($request->all(), [
            'idade' => 'required|integer|min:1',
            'endereco' => 'required|string|max:120',
            'telefone' => 'required|string|min:1',
        ]);

        if ($validator->fails()) {
            return redirect()->route('funcionarioperfil.edit', $funcionarioId)
            ->with('error', 'Erro de validação: Altere um campo ou não deixe-o o vazio.');
        }

        $sql = "UPDATE perfil_funcionario SET idade = ?, endereco = ?, telefone = ?, updated_at = ? WHERE funcionario_id = ?";
        
        DB::update($sql, [
            $request->idade,
            $request->endereco,
            $request->telefone,
            now(),
            $funcionarioId,
        ]);

        return redirect()->route('funcionarioperfil.show', [$funcionarioId])->with('success', 'Funcionário atualizado com sucesso!');
    }
    public function destroy($funcionarioId)
    {
        $sql = "DELETE FROM perfil_funcionario WHERE funcionario_id = ?";
        
        DB::delete($sql, [$funcionarioId]);

        return response()->json([
            'menssage' => 'Perfil do funcionário excluído com sucesso!'. $funcionarioId
        ]);
    }

}
