<?php

namespace App\Http\Controllers;
use App\Models\Prod_vendido;
use App\Models\Prod_Carrinho;

use Illuminate\Http\Request;

class Prod_vendidoController extends Controller
{

    public function showSucesso(){
        return view('pedidos.pedido-concluido');
    }

    public static function store($id_pedido){

        //pega todos os itens do carrinho no banco
        // $produtos = app(Prod_carrinhoController::class)->carrinhoItens();
        //refiz a função pois dava conflito
        try {

            $produtos = Prod_Carrinho::where('id_usuario', \Auth::user()->id)
                                            ->join('produtos','prod__carrinhos.id_produto', '=','produtos.id')
                                            ->select('prod__carrinhos.*','produtos.nome','produtos.preco','produtos.foto','produtos.peso')
                                            ->get();



            foreach ($produtos as $produto){

                $prod_vendido = new Prod_vendido;

                //(por enquanto) O resultado está voltando em um array dentro de array
                //por isso o [0]
                $prod_vendido->valor_unitario = $produto->preco;
                $prod_vendido->quantidade = $produto->quantidade;
                $prod_vendido->id_pedido = $id_pedido;
                $prod_vendido->id_produto = $produto->id_produto;


                    \DB::beginTransaction();
                        $prod_vendido->save();
                        \DB::commit();

                            //Após o processo de registro da compra, o carrinho é esvaziado
                            Prod_Carrinho::destroy($produto->id);


            }


        }catch (\Throwable $th) {
            return $th->getMessage();

        }


        //Redireciona a pagina de sucesso
        return redirect('/pedido-concluido');

    }
}
