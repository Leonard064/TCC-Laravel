<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\Endereco;
use App\Http\Controllers\Prod_vendidosController;

use Auth;

class PedidoController extends Controller
{

    //chamadas CRUD
    //Função de salvar Pedidos - Endereço criado em Checkout
    public static function store(Request $request){

        $endereco = Endereco::where('id',$request->id_endereco)->first();

        $pedido = new Pedido;

        // $pedido->total_pedido += $request->frete_valor;

        $pedido->total_pedido = $request->total_pedido;
        $pedido->frete_tipo = $request->frete_tipo;
        $pedido->frete_valor = $request->frete_valor;
        $pedido->pagamento_tipo = $request->pagamento_tipo;
        $pedido->status = 'Em Análise'; //por padrão, não há confirmação de pagamento
        $pedido->id_usuario = \Auth::user()->id;
        $pedido->cep = $endereco->cep;
        $pedido->endereco = $endereco->endereco;
        $pedido->numero = $endereco->numero;
        $pedido->bairro = $endereco->bairro;
        $pedido->municipio = $endereco->municipio;
        $pedido->estado = $endereco->estado;

            // começa a salvar pedido
            try {

                \DB::beginTransaction();

                    $pedido->save();

                        \DB::commit();

                            $id_pedido = $pedido->id; //pega o id criado...



                //...e o envia para a função de criação de Produtos Vendidos
                return Prod_vendidoController::store($id_pedido);


            } catch (\Throwable $th) {

                echo $th->getMessage();
                \DB::rollback();

            }
    }


    public function editPedidoStat($id){

        if(Auth::check()){
            if(Auth::user()->tipo == 'adm'){
                if($pedido = Pedido::find($id)){

                    if($pedido->status == 'Aprovado'){
                        return redirect('/dashboard')->with('err','Atenção - Pedido já está Aprovado');
                    }

                        $pedido->status = "Aprovado";

                        try {
                            $pedido->save();

                            return redirect('/dashboard')->with('ok','Pedido atualizado - Status Aprovado');

                        } catch (\Throwable $th) {
                            echo $th->getMessage();

                        }

                }

            }
        }

        return redirect('/');

    }

}
