<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;
use App\http\Controllers\UsuarioController;

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

//Produtos

Route::get('/', [ProdutoController::class, 'index']);


/* ---- Funções de teste ----

Route::get('/produtos', [ProdutoController::class, 'showPesquisa']);

Route::get('/produtos/{categoria}',[ProdutoController::class, 'showCat']);

*/

Route::get('/produtos/{categoria?}',[ProdutoController::class, 'showProdutos']);

Route::get('/detalhes/{id}', [ProdutoController::class, 'show']);

Route::get('/create-produto',[ProdutoController::class, 'create']);

Route::post('/produtos/create', [ProdutoController::class, 'store']);


//Usuários

Route::get('/login',[UsuarioController::class, 'create']);

Route::get('/entrar',[UsuarioController::class, 'authenticate']);

Route::post('/registrar',[UsuarioController::class, 'store']);
