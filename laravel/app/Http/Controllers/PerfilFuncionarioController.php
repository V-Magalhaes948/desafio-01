<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\DB;
use App\Models\PerfilFuncionario;

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
        return view('perfilfuncionario.create', [
            'funcionarioId' => $funcionarioId
        ]);
    }


    public function store(Request $request, $funcionarioId)
    {
        // Validação dos dados do formulário
        $request->validate([
            // 'funcionarioId' => 'required|exists:funcionario,id',
            'idade' => 'required|integer',
            'endereco' => 'nullable|string|max:255',
            'telefone' => 'required|string|max:20',
            
        ]);

        // $funcionario = Funcionario::find($request->funcionarioId);
        // if (!$funcionario) {
        //     // Redirecionamento ou resposta de erro se o funcionário não existir
        //     return redirect()->back()->withErrors('Funcionário não encontrado.');
        // }
        

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
        return redirect()->route('funcionarioperfil.create', $funcionarioId)
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

        // if ($confirmaPerfilFuncionario) {
        //     return response()->json([
        //         'message:' => 'Perfil do funcionário já existe!'
        //     ], $confirmaPerfilFuncionario);
        // } else {
        //     return response()->json([
        //         'message:' => 'Perfil do funcionário não existe!'
        //     ]);
        // }
        // Verifica se perfil_funcionario já existe para o id que recebeu, se existir o perfil mostrar a tabela
        // Colocar um link para editar um perfil na tabela, criando um método update
        // Se não existir libera um link para cadastrar um novo perfil_funcionario

        return view('perfilfuncionario.show', [
            'funcionarioId' => $funcionarioId   
        ]);
    }

    public function edit(Request $request, $funcionarioId) {
        
        $sql = "SELECT * FROM perfil_funcionario WHERE funcionario_id = ?";

        $perfilDoFuncionario = DB::select($sql, [
            $funcionarioId  
        ]);


        return view('perfilfuncionario.edit', [
            'funcionarioPerfil' => $perfilDoFuncionario[0],
            'funcionarioId' => $funcionarioId
        ]);
    }

    public function update(Request $request, $funcionarioId) {
        $request->validate([
            'idade' => 'required|integer|max:2',
            'endereco' => 'required|string|max:255',
            'telefone' => 'required|string|min:0',
        ]);

        // $perfil = PerfilFuncionario::where('funcionario_id', $funcionarioId)->first();

        // if (!$perfil) {
        //     return redirect()->route('perfilfuncionario.show', ['funcionario_id' => $funcionarioId])->with('error', 'Perfil do funcionário não encontrado.');
        // }

        // Query SQL para atualizar os dados do funcionário
        $sql = "UPDATE perfil_funcionario SET idade = ?, endereco = ?, telefone = ?, updated_at = ? WHERE funcionario_id = ?";
        
        DB::update($sql, [
            $request->idade,
            $request->endereco,
            $request->telefone,
            now(),
            $funcionarioId,
        ]);

        // Redireciona de volta para a página do funcionário ou retorna uma mensagem de sucesso
        return redirect()->route('perfilfuncionario.show', ['funcionarioId' => $funcionarioId])->with('success', 'Funcionário atualizado com sucesso!');
    }

}
