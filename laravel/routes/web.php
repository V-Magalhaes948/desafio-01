<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\PerfilFuncionarioController;



Route::get('/', [FuncionarioController::class, 'index'])->name('funcionario.index');

Route::get('/funcionario/cadastro', [FuncionarioController::class, 'create'])->name('funcionario.create');

Route::post('/funcionario', [FuncionarioController::class, 'store'])->name('funcionario.store');

Route::get('/funcionario/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionario.edit');

Route::put('/funcionario/{id}', [FuncionarioController::class, 'update'])->name('funcionario.update');

Route::delete('/funcionario/{id}', [FuncionarioController::class, 'destroy'])->name('funcionario.destroy');

Route::get('/funcionarioperfil/{id}/cadastro', [PerfilFuncionarioController::class, 'create'])->name('funcionarioperfil.create');

Route::post('/funcionarioperfil/{id}', [PerfilFuncionarioController::class, 'store'])->name('funcionarioperfil.store');

Route::get('/funcionarioperfil/{id}', [PerfilFuncionarioController::class, 'show'])->name('funcionarioperfil.show');

Route::get('/funcionarioperfil/{id}/edit', [PerfilFuncionarioController::class, 'edit'])->name('funcionarioperfil.edit');

Route::put('/funcionarioperfil/{id}', [PerfilFuncionarioController::class, 'update'])->name('funcionarioperfil.update');

Route::delete('/funcionarioperfil/{id}', [PerfilFuncionarioController::class, 'destroy'])->name('funcionarioperfil.destroy');

