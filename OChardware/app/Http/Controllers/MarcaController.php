<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Marca;

class MarcaController extends Controller
{
    public function create(){
        return view('produtos.marcas.create-marca');
    }

    public function store(Request $request){

        $valida = Validator::make($request->all(),[
           'nome' => 'required|min:2|max:50|unique:marcas'
        ],[
            'required' => 'Campo está vazio.',
            'min' => 'Valor muito pequeno.',
            'max' => 'Valor maior que o aceito.',
            'unique' => 'Marca já existe.',
        ]);

        if($valida->fails()){
            return redirect()
                        ->back()
                        ->withErrors($valida)
                        ->withInput();
        }else{
            $valores = $valida->validated();
            $marca = new Marca;

            $marca->fill($valores);

                try {

                    \DB::beginTransaction();
                    $marca->save();
                    \DB::commit();

                    $request->session()->flash('ok','Marca salva com sucesso');
                    return redirect('/dashboard');

                } catch (\Throwable $th) {

                    \DB::rollback();
                    $request->session()->flash('err','Marca não pode ser salva');
                }

        }

    }
}
