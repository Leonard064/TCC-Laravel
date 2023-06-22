<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\Endereco;
use App\Http\Controllers\Prod_vendidosController;

class PedidoController extends Controller
{

    //chamada de páginas
    //página Todos os Pedidos (Dashboard ADM)
    public function showAdmPedidos(){
        // $pedido = Pedido::all();
        $pedido = Pedido::orderBy('created_at', 'DESC')->get();

        return view('pedidos.showAdmPedidos', ['pedido' => $pedido]);
    }


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

}
