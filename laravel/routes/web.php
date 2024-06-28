<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FuncionarioController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/funcionario', [FuncionarioController::class, 'index'])->name('funcionario.index');

Route::get('/funcionario/cadastro', [FuncionarioController::class, 'create'])->name('funcionario.create');

Route::post('/funcionario', [FuncionarioController::class, 'store'])->name('funcionario.store');

Route::get('/funcionario/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionario.edit');

Route::put('/funcionario/{id}', [FuncionarioController::class, 'update'])->name('funcionario.update');

Route::delete('/funcionarios/{id}', [FuncionarioController::class, 'destroy'])->name('funcionario.destroy');
