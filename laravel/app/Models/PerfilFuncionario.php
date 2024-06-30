<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilFuncionario extends Model
{
    use HasFactory;

    protected $fillable = [
        'idade', 'endereco', 'telefone', 'funcionarioId'
    ];

    // Definindo a relação com Funcionario
    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class, 'funcionarioId');
    }
}
