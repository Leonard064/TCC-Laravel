<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Prod_Carrinho;
use App\Models\Endereco;
use Auth;


class Prod_carrinhoController extends Controller
{

    /* função de pegar os itens do carrinho no banco
        usada na página de carrinho e checkout */
    public function carrinhoItens(){
        try {

            $prod_carrinho = Prod_Carrinho::where('id_usuario', Auth::user()->id)
                                            ->join('produtos','prod__carrinhos.id_produto', '=','produtos.id')
                                            ->select('prod__carrinhos.*','produtos.nome','produtos.preco','produtos.foto','produtos.peso','produtos.comprimento','produtos.altura','produtos.largura')
                                            ->get();



             return ['prod_carrinho' => $prod_carrinho];


        }catch (\Throwable $th) {
            return $th->getMessage();

        }
    }



    //chamada de páginas
    public function showCarrinho(){

        //checa se usuário está logado
        if(Auth::check()){
            try {

                return view('carrinho.carrinho', $this->carrinhoItens());

            }catch (\Throwable $th) {

                echo $th->getMessage();

            }

        }else{
            return redirect('/');

        }

    }



    public function showCheckout(){
        if(Auth::check()){
            try {

                $enderecos = Endereco::where('id_usuario', \Auth::user()->id)->get();

                return view('carrinho.checkout',$this->carrinhoItens(),['enderecos' => $enderecos]);

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

                //checa se o item já está no carrinho
                $query = Prod_Carrinho::where('id_produto', $request->id)
                              ->where('id_usuario', Auth::user()->id)
                              ->get();

                if(count($query) > 0) {
                    $request->session()->flash('err','Produto já está no carrinho');
                    return redirect('/carrinho');
                } else {
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


    //adiciona uma (1) quantidade ao item selecionado
    public function addQtdCarrinho($id){

        if(Auth::check()){
            try {
                $carrinhoItem = Prod_Carrinho::find($id);

                $carrinhoItem->quantidade += 1;

                $carrinhoItem->save();

                return redirect('/carrinho');

            } catch (\Throwable $th) {

                echo $th->getMessage();
            }
        }

        return redirect('/');

    }


    //remove uma (1) quantidade ao item selecionado
    public function removeQtdCarrinho($id){

        if(Auth::check()){
            try {
                $carrinhoItem = Prod_Carrinho::find($id);

                if($carrinhoItem->quantidade > 1){ //checa se há quantidade a ser removida

                    $carrinhoItem->quantidade -= 1;

                    $carrinhoItem->save();

                    return redirect('/carrinho');

                }else{ //caso não, remove o item do carrinho

                    $this->removerCarrinho($id);

                }


            } catch (\Throwable $th) {

                echo $th->getMessage();
            }

        }

        return redirect('/');

    }


    public function removerCarrinho($id){

        if(Auth::check()){
            try {
                if(Prod_Carrinho::destroy($id)) {
                    return redirect('/carrinho')->with('ok','Item removido do carrinho');

                }else{
                    return redirect('/carrinho')->with('err','Não foi possível deletar o item');
                }

            } catch (\Throwable $th) {
                echo $th->getMessage();

            }

        }

        return redirect('/');

    }
}
