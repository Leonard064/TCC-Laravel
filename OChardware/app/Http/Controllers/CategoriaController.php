<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    public function create(){
        return view('produtos.categorias.create-categoria');
    }

    public function store(Request $request){
        $valores = $request->all();
        $categoria = new Categoria;

        $categoria->fill($valores);

            try {
                \DB::beginTransaction();
                $categoria->save();
                \DB::commit();

                $request->session()->flash('ok','Categoria salva com sucesso');
                return redirect('/dashboard');
            } catch (\Throwable $th) {
                \DB::rollback();

                $request->session()->flash('err','Categoria não foi salva');
            }
    }
}
