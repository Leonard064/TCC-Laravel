<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Endereco;
use App\Http\Controllers\PedidoController;

class EnderecoController extends Controller
{
    //chamada de páginas
    public function showAddEndereco(){

        $enderecos = Endereco::where('id_usuario', \Auth::user()->id)->get();

        return view('usuarios.adicionar-endereco',['enderecos' => $enderecos]);
    }

    //funções
    public function store(Request $request){
        $valores = $request->all();

        $endereco = new Endereco;
        $endereco->fill($valores);

        $endereco->id_usuario = \Auth::user()->id;

        try {
            \DB::beginTransaction();
            $endereco->save();
            \DB::commit();

            $id_endereco = $endereco->id;

            return $id_endereco;

        } catch (\Throwable $th) {
            echo $th->getMessage();
            \DB::rollback();
        }
    }


    //criação de enderço via página Adicionar Endereço
    public function addEnderecoPerfil(Request $request){

        try {
            $this->store($request);

            $request->session()->flash('ok','Endereço salvo com sucesso');
            return redirect('/perfil');

        } catch (\Throwable $th) {
            echo $th->getMessage();

        }
    }


    //criação de endereço via página Checkout
    public function addEnderecoCheckout(Request $request){
        try {

            //salva o endereço e chama a função de salvar pedido (enviando o id do endereco)
            return PedidoController::store($request, $this->store($request));

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
