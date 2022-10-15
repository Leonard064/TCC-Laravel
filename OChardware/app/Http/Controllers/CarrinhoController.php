<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrinho;

class CarrinhoController extends Controller
{
    public function showCarrinho(){
        return view('carrinho.carrinho');
    }

}
