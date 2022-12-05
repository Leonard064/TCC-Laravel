<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function create(){
        return view('produtos.marcas.create-marca');
    }

    public function store(Request $request){
        $valores = $request->all();
        $marca = new Marca;

        $marca->fill($valores);

            try {

                $checaMarca = Marca::where('nome', $marca->nome)->first();

                    if($checaMarca){
                        $request->session()->flash('err','Marca já cadastrada');
                    }

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
