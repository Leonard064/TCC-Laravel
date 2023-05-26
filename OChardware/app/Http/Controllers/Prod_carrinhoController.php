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
                                            ->select('prod__carrinhos.*','produtos.nome','produtos.preco','produtos.foto','produtos.peso')
                                            ->get();


            // //isso aqui tudo é só jesus na causa
            // $prod_carrinho = Prod_Carrinho::where('id_usuario', Auth::user()->id)->get(); //pega todos os itens do carrinho do usuário

            //     $carrinho = []; //inicia um array vazio.

            //     //pra cada item do carrinho ele busca o produto especifico...
            //     foreach($prod_carrinho as $item_carrinho){

            //         //...e tranforma o resultado em array(e coloca dentro de outro array)
            //         array_push($carrinho, Produto::where('id', $item_carrinho->id_produto)->get()->toArray());
            //     }


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

                //$total = $request->total;

                // $frete = $request->frete;

                // if($frete == 'sedex'){
                //     $valor_frete = 27.00;
                //     $total = $request->total + $valor_frete;
                // }else{
                //     $valor_frete = 14.90;
                //     $total = $request->total + $valor_frete;
                // }

                // dd($frete);

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
        try {
            $carrinhoItem = Prod_Carrinho::find($id);

            $carrinhoItem->quantidade += 1;

            $carrinhoItem->save();

            return redirect('/carrinho');

        } catch (\Throwable $th) {

            echo $th->getMessage();
        }
    }


    //remove uma (1) quantidade ao item selecionado
    public function removeQtdCarrinho($id){
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


    public function removerCarrinho($id){

        try {
            if(Prod_Carrinho::destroy($id)) {
                return redirect('/carrinho')->with('ok','Item removido do carrinho');

            }else{
                dd('Não foi possível deletar o item');
            }

        } catch (\Throwable $th) {
            echo $th->getMessage();

        }
    }
}
