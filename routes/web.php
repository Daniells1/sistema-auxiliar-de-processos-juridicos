<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SistemaController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PessoaController;
use App\Http\Controllers\ProcessoController;
use App\Http\Controllers\RelatorioController;

Route::match(['get', 'post'], '/', [LoginController::class, 'index'])->name("home");
Route::match(['get', 'post'], '/login', [LoginController::class, 'index'])->name("login");
Route::match(['get', 'post'], '/esqueceu-senha', [LoginController::class, 'esqueceuSenha'])->name("esqueceu-senha");
Route::get('/logout', [LoginController::class, 'logout'])->name("logout");
Route::middleware(['auth'])->prefix("admin")->name("admin.")->group(function(){

    Route::get('/', [SistemaController::class, 'index'])->name("home");
    Route::match(['get', 'post'], '/meus-dados', [SistemaController::class, 'meusDados'])->name("meus-dados");

    Route::middleware('can:adm,App\Models\Usuario')->prefix("usuarios")->name("usuarios.")->group(function(){
       
        Route::get('/novo', [UsuarioController::class, 'novo'])->name("novo");
        
        Route::post('/novo', [UsuarioController::class, 'novoSave'])->name("novoSave");

        Route::match(['get', 'post'], '/buscar', [UsuarioController::class, 'buscar'])->name("buscar");

        Route::get('/{id}/{ativo}/ativar', [UsuarioController::class, 'ativar'])->name("ativar");
     
        
    });

    Route::middleware('can:adm,App\Models\Usuario')->prefix("pessoas")->name("pessoas.")->group(function(){
        Route::match(['get', 'post'], '/autor', [PessoaController::class, 'autor'])->name("autor");
        Route::match(['get', 'post'], '/reu', [PessoaController::class, 'reu'])->name("reu");
        Route::match(['get', 'post'], '/advogado', [PessoaController::class, 'advogado'])->name("advogado");


     
    });

    Route::middleware('can:funcionario,App\Models\Usuario')->prefix("processos")->name("processos.")->group(function(){
        Route::get('/novo', [ProcessoController::class, 'novo'])->name("novo");
        Route:: post('/salvar', [ProcessoController::class, 'processoSave'])->name("processo-save");
        Route::match(['get', 'post'], '/buscar', [ProcessoController::class, 'buscar'])->name("buscar");
        Route::get('/{id}/audiencia', [ProcessoController::class, 'audiencia'])->name("audiencia");
        Route::post('/{id}/audiencia', [ProcessoController::class, 'audienciaSave'])->name("audiencia-save");
        Route::get('/detalhes', [ProcessoController::class, 'detalhes'])->name("detalhes");

     
    });

    Route::middleware('can:funcionario,App\Models\Usuario')->prefix("relatorio")->name("relatorio.")->group(function(){
        Route::match(['get', 'post'], '/autor', [RelatorioController::class, 'autor'])->name("autor");
        Route::match(['get', 'post'], '/processo', [RelatorioController::class, 'processo'])->name("processo");
        Route::match(['get', 'post'], '/advogado', [RelatorioController::class, 'advogado'])->name("advogado");
        Route::get('/processo/download', [RelatorioController::class, 'processoPdf'])->name("processo-pdf");

     
    });
});


