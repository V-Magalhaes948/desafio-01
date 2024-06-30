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
        // $a = DB::table('perfil_funcionario')->get()->toJson();
        // dump($a);
        // $funcionario = Funcionario::find($funcionarioId);
        // if(!$funcionario) {
        //     return redirect()->back()->withErrors('Funcionário não encontrado.');
        // }
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

        // Redireciona de volta para o formulário com uma mensagem de sucesso
        return redirect()->route('funcionarioperfil.show', $funcionarioId)
                ->with('success', 'Funcionário cadastrado com sucesso!');
    }

    public function show(Request $request, $funcionarioId)
    {
        // Verifica se funcionário existe (alert)
        // if (!$funcionarioId) {
        //     return response()->json([
        //         'menssage:' => 'Funcionário não existente.'. $id
        //     ]);
        // }

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
            return redirect()->route('perfilFuncionario.edit', $funcionarioId)
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

        // Redireciona de volta para a página do funcionário ou retorna uma mensagem de sucesso
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
