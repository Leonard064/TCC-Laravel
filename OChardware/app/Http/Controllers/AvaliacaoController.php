<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Avaliacao;

class AvaliacaoController extends Controller
{

    public function store(Request $request){

        $valida = Validator::make($request->all(),[
            'gostou' => 'required|in:1,0',
            'texto_avaliacao' => 'required|min:2|max:100',
        ],[
            'required' => 'O campo é obrigatório',
            'min' => 'Campo é menor que o valor esperado.',
            'max' => 'Campo maior que o valor aceito.',
        ]);

        if($valida->fails()){
            return redirect()
                        ->back()
                        ->withErrors($valida)
                        ->withInput();
        }else{

            $valores = $valida->validated();
            $avaliacao = new Avaliacao;

            $avaliacao->fill($valores);

                try {
                    \DB::beginTransaction();
                    $avaliacao->save();
                    \DB::commit();

                    $request->session()->flash('ok','Sua avaliação foi publicada');
                    return redirect('/detalhes/'.$avaliacao->id_produto);

                } catch (\Throwable $th) {
                    \DB::rollback();

                    echo $th->getMessage();
                }
        }

    }
}
