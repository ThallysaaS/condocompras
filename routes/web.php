<?php

use App\Filament\Resources\CotacaoResource\Pages\RealizarCotacao;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\HomeController;

Route::get('/realizar-cotacao', RealizarCotacao::class)->name('realizar-cotacao');
Route::get('/empresas/{id}', [EmpresaController::class, 'show'])->name('empresas.show');
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cadastro', function () {
    return redirect()->to(UserResource::getUrl('create'));
})->name('cadastro');
