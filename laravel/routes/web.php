<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PerfilFuncionarioController;



// Rota inicial
Route::get('/', [FuncionarioController::class, 'index'])->name('funcionario.index');

// Rotas para Funcionário
Route::prefix('funcionario')->name('funcionario.')->group(function () {
    Route::get('/cadastro', [FuncionarioController::class, 'create'])->name('create');
    Route::post('/', [FuncionarioController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [FuncionarioController::class, 'edit'])->name('edit');
    Route::put('/{id}', [FuncionarioController::class, 'update'])->name('update');
    Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->name('destroy');
});

// Rotas para Perfil de Funcionário
Route::prefix('funcionarioperfil')->name('funcionarioperfil.')->group(function () {
    Route::get('/{id}/cadastro', [PerfilFuncionarioController::class, 'create'])->name('create');
    Route::post('/{id}', [PerfilFuncionarioController::class, 'store'])->name('store');
    Route::get('/{id}', [PerfilFuncionarioController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PerfilFuncionarioController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PerfilFuncionarioController::class, 'update'])->name('update');
    Route::delete('/{id}', [PerfilFuncionarioController::class, 'destroy'])->name('destroy');
});
