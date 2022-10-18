<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Prod_Carrinho;
use Auth;


class Prod_carrinhoController extends Controller
{

    //chamada de páginas
    public function showCarrinho(){

        //checa se usuário está logado
        if(Auth::check()){
            try {

                //isso aqui tudo é só jesus na causa
                $prod_carrinho = Prod_Carrinho::where('id_usuario', Auth::user()->id)->get(); //pega todos os itens do carrinho do usuário

                    $carrinho = []; //inicia um array vazio.

                    //pra cada item do carrinho ele busca o produto especifico...
                    foreach($prod_carrinho as $item_carrinho){

                        //...e tranforma o resultado em array(e coloca dentro de outro array)
                        array_push($carrinho, Produto::where('id', $item_carrinho->id_produto)->get()->toArray());
                    }


                return view('carrinho.carrinho', ['carrinho' => $carrinho, 'prod_carrinho' => $prod_carrinho]);

            }catch (\Throwable $th) {
                echo $th->getMessage();

            }

        }else{
            return redirect('/');

        }

    }

    //chamadas CRUD
    public function addCarrinho(Request $request){

        //checa se usuário está logado
        if(Auth::check()){

            //checa se o produto existe
            if(Produto::findOrFail($request->id)){
                $prod_carrinho = new Prod_Carrinho;

                $prod_carrinho->quantidade = 1;
                $prod_carrinho->id_produto = $request->id;
                $prod_carrinho->id_usuario = Auth::user()->id;

                try {

                    $prod_carrinho->save();
                    $request->session()->flash('ok','Produto adicionado ao carrinho');
                    return redirect('/carrinho');

                } catch (\Throwable $th) {
                    echo $th->getMessage();
                }
            }else{

                $request->session()->flash('err','ERRO - Produto não existe');
                return redirect('/');
            }

        }else{

            $request->session()->flash('err','Entre para realizar compras');
            return redirect('/login');
        }
    }

    public function removerCarrinho($id){

        try {
            if(Prod_Carrinho::destroy($id)) {
                return redirect('/carrinho');

            }else{
                dd('Não foi possível deletar o item');
            }

        } catch (\Throwable $th) {
            echo $th->getMessage();

        }
    }
}
