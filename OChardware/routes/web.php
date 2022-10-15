<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;
use App\http\Controllers\UsuarioController;
use App\Http\Controllers\CarrinhoController;

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

//Carrinho
Route::get('/carrinho',[CarrinhoController::class, 'showCarrinho']);

Route::get('/carrinho/{id}',[CarrinhoController::class, 'addCarrinho']);

//Usuários

//Criação, autenticação e logoff
Route::get('/login',[UsuarioController::class, 'create']);

Route::post('/registrar',[UsuarioController::class, 'store']);

Route::post('/entrar',[UsuarioController::class, 'authenticate']);

Route::get('/logout',[UsuarioController::class, 'logout']);

//Rotas nível usuário

Route::get('/perfil',[UsuarioController::class, 'perfil']);

//Rotas nível Admin

Route::get('/dashboard',[UsuarioController::class, 'dashboard']);
