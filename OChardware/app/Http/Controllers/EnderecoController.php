<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Endereco;
use App\Http\Controllers\PedidoController;

class EnderecoController extends Controller
{
    //chamada de páginas
    public function showAddEndereco(){

        $enderecos = Endereco::where('id_usuario', \Auth::user()->id)->get();

        return view('enderecos.adicionar-endereco',['enderecos' => $enderecos]);
    }


    public function showEditEndereco($id){
        try {
            $endereco = Endereco::findOrFail($id);

            return view('enderecos.edit-endereco',['endereco' => $endereco]);

        } catch (\Throwable $th) {

            echo $th->getMessage();

        }
    }

    //funções CRUD

    //criação de endereço
    // public function store(Request $request){

    //     $valida = Validator::make($request->all(),[
    //         'cep' => 'required|min:8|max:8',
    //         'endereco' => 'required|min:4|max:100',
    //         'numero' => 'required|max:5',
    //         'bairro' => 'required|min:3|max:50',
    //         'estado' => 'required|min:3|max:50',
    //         'municipio' => 'required|min:3|max:100',
    //     ],[
    //         'required' => 'Campo obrigatório',
    //         'min' => 'O valor inserido é muito pequeno.',
    //         'max' => 'O valor inserido é maior que o aceito.',
    //     ]);

    //     if($valida->fails()){
    //         return redirect('/adicionar-endereco')
    //                                 ->withErrors();
    //     } else {

    //         $valores = $valida->validate();

    //         $endereco = new Endereco;
    //         $endereco->fill($valores);

    //         $endereco->id_usuario = \Auth::user()->id;

    //         try {
    //             \DB::beginTransaction();
    //             $endereco->save();
    //             \DB::commit();

    //             $id_endereco = $endereco->id;

    //             return $id_endereco;

    //         } catch (\Throwable $th) {
    //             echo $th->getMessage();
    //             \DB::rollback();
    //         }
    //     }

    // }


    //criação de endereço
    public function addEnderecoPerfil(Request $request){

        $valida = Validator::make($request->all(),[
            'cep' => 'required|between:8,8',
            'endereco' => 'required|min:4|max:100',
            'numero' => 'required|min:1|max:5',
            'bairro' => 'required|min:3|max:50',
            'estado' => 'required|min:3|max:50',
            'municipio' => 'required|min:3|max:100',
        ],[
            'required' => 'Campo obrigatório',
            'min' => 'O valor inserido é muito pequeno.',
            'max' => 'O valor inserido é maior que o aceito.',
            'between' => 'Tamanho Inválido.',
        ]);

        if($valida->fails()){
            return redirect('/adicionar-endereco')
                                    ->withErrors($valida);
        } else {

            $valores = $valida->validate();

            $endereco = new Endereco;
            $endereco->fill($valores);

            $endereco->id_usuario = \Auth::user()->id;

            try {
                \DB::beginTransaction();
                $endereco->save();
                \DB::commit();

                $request->session()->flash('ok','Endereço salvo com sucesso');
                return redirect('/adicionar-endereco');

            } catch (\Throwable $th) {
                echo $th->getMessage();
                \DB::rollback();
            }
        }

    }


    //criação de endereço via página Checkout
    public function addEnderecoCheckout(Request $request){
        try {

            $this->store($request);

            $request->session()->flash('ok','Endereço salvo com sucesso');
            return redirect('/checkout');

            // //salva o endereço e chama a função de salvar pedido (enviando o id do endereco)
            // return PedidoController::storeSemEndereco($request, $this->store($request));

        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }


    //update de endereço
    public function updateEndereco(Request $request){

        $valida = Validator::make($request->all(),[
            'cep' => 'required|between:8,8',
            'endereco' => 'required|min:4|max:100',
            'numero' => 'required|min:1|max:5',
            'bairro' => 'required|min:3|max:50',
            'estado' => 'required|min:3|max:50',
            'municipio' => 'required|min:3|max:100',
        ],[
            'required' => 'Campo obrigatório',
            'min' => 'O valor inserido é muito pequeno.',
            'max' => 'O valor inserido é maior que o aceito.',
            'between' => 'Tamanho Inválido.',
        ]);

        if($valida->fails()){
            return redirect()
                        ->back()
                        ->withErrors($valida);

        }else{
            try {

                $endereco = Endereco::find($request->id);

                $valores = $valida->validated();

                $endereco->fill($valores);

                $endereco->save();

                $request->session()->flash('ok','Endereço atualizado com sucesso');
                return redirect('/adicionar-endereco');

            } catch (\Throwable $th) {

                echo $th->getMessage();

            }

        }

    }


    //remover endereço
    public function removerEndereco($id){

        try {

            if(Endereco::destroy($id)){

                \Session::flash('ok','Endereço excluído com sucesso');
                return redirect('/adicionar-endereco');

            }else{

                \Session::flash('err','Endereço não foi excluído');
                return redirect('/adicionar-endereco');
            }

        } catch (\Throwable $th) {

            echo $th->getMessage();

        }

    }
}
