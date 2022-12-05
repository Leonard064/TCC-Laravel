<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avaliacao;

class AvaliacaoController extends Controller
{
    public function store(Request $request){
        $valores = $request->all();
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
