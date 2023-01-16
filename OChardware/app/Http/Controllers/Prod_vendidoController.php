<?php

namespace App\Http\Controllers;
use App\Models\Prod_vendido;
use App\Models\Prod_Carrinho;

use Illuminate\Http\Request;

class Prod_vendidoController extends Controller
{
    public static function store($id_pedido){

        //pega todos os itens do carrinho no banco
        //--- chama a função 'carrinhoItens' do controller 'Prod_Carrinho' ---
        $produtos = app(Prod_carrinhoController::class)->carrinhoItens();


        //para cada item ele cria um registro na tabela "Produtos Vendidos"
        foreach ($produtos as $produto){

            $prod_vendido = new Prod_vendido;

            //(por enquanto) O resultado está voltando em um array dentro de array
            //por isso o [0]
            $prod_vendido->valor_unitario = $produto[0]->preco;
            $prod_vendido->quantidade = $produto[0]->quantidade;
            $prod_vendido->id_pedido = $id_pedido;
            $prod_vendido->id_produto = $produto[0]->id_produto;

                try {
                    \DB::beginTransaction();
                        $prod_vendido->save();
                        \DB::commit();

                            //Após o processo de registro da compra, o carrinho é esvaziado
                            Prod_Carrinho::destroy($produto[0]->id);

                } catch (\Throwable $th) {
                    echo $th->getMessage();
                        \DB::rollback();

                }
        }

        //Redireciona ao Index
        //--- depois criar página de sucesso ---
        \Session::flash('ok','Pedido concluído!');
        return redirect('/');


    }
}
