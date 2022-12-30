<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProdutoController;
use App\http\Controllers\UsuarioController;
use App\Http\Controllers\Prod_carrinhoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\EnderecoController;

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

/* =====================
      --- Produtos ---
  =======================*/

Route::get('/', [ProdutoController::class, 'index']);

Route::get('/produtos/{id_categoria?}',[ProdutoController::class, 'showProdutos']);

Route::get('/detalhes/{id}', [ProdutoController::class, 'show']);

Route::get('/create-produto',[ProdutoController::class, 'create']);

Route::post('/produtos/create', [ProdutoController::class, 'store']);


/* ====================
    --- Categoria ---
   ====================*/

Route::get('/create-categoria', [CategoriaController::class, 'create']);

Route::post('/categorias/create', [CategoriaController::class, 'store']);



/* ====================
    --- Marca ---
   ====================*/

Route::get('/create-marca', [MarcaController::class, 'create']);

Route::post('/marcas/create', [MarcaController::class, 'store']);


/* ====================
    --- Carrinho ---
   ====================*/

Route::get('/carrinho',[Prod_carrinhoController::class, 'showCarrinho']);

Route::post('/addCarrinho',[Prod_carrinhoController::class, 'addCarrinho']);

Route::get('/removerCarrinho/{id}', [Prod_carrinhoController::class, 'removerCarrinho']);

Route::post('/checkout',[Prod_carrinhoController::class, 'showCheckout']);



/* ====================
    --- Endereço ---
   ====================*/

Route::post('/endereco/create', [EnderecoController::class, 'addEnderecoPerfil']);

Route::post('/endereco/create-via-checkout', [EnderecoController::class, 'addEnderecoCheckout']);


/* ====================
    --- Avaliação ---
   ====================*/

Route::post('/avaliacoes/create', [AvaliacaoController::class, 'store']);



/* ====================
    --- Usuários ---
   ====================*/

//Criação, autenticação e logoff
Route::get('/login',[UsuarioController::class, 'showLogin']);

Route::get('/cadastre-se',[UsuarioController::class, 'showCadastre']);

Route::post('/registrar',[UsuarioController::class, 'store']);

Route::post('/entrar',[UsuarioController::class, 'authenticate']);

Route::get('/logout',[UsuarioController::class, 'logout']);


//Rotas nível usuário

Route::get('/perfil',[UsuarioController::class, 'perfil']);

Route::get('/editar-perfil',[UsuarioController::class, 'showEditPerfil']);

Route::get('/adicionar-endereco', [EnderecoController::class, 'showAddEndereco']);

Route::post('/update-perfil',[UsuarioController::class, 'updatePerfil']);


//Rotas nível Admin

Route::get('/dashboard',[UsuarioController::class, 'dashboard']);

Route::get('/editar-produto/{id}', [ProdutoController::class, 'showEditProduto']);

Route::get('remover-produto/{id}', [ProdutoController::class, 'removerProduto']);

Route::get('/todos-produtos', [ProdutoController::class, 'showAdmProdutos']);
