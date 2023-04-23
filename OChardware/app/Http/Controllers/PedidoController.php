<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Http\Controllers\Prod_vendidosController;

class PedidoController extends Controller
{
    //Função de salvar Pedidos - Endereço criado em Checkout
    public static function store(Request $request){

        $valores = $request->all();

        //devido a propriedade "Fillable" todos os campos precisam ir na mesma ordem declarada no Model
        $pedido = new Pedido;
        $pedido->fill($valores);

        // $pedido->total_pedido += $request->frete_valor;

        $pedido->status = 'Em Análise'; //por padrão, não há confirmação de pagamento
        $pedido->id_usuario = \Auth::user()->id;

        $pedido->id_endereco = $id_endereco;

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

        if($pedido = Pedido::find($id)){

            $pedido->status = "Aprovado";

            try {
                $pedido->save();

                return redirect('/dashboard');

            } catch (\Throwable $th) {
                echo $th->getMessage();

            }
        }
    }

    //página Todos os Pedidos (Dashboard ADM)
    public function showAdmPedidos(){
        $pedido = Pedido::all();

        return view('pedidos.showAdmPedidos', ['pedido' => $pedido]);
    }


}
