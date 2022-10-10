<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsuarioController extends Controller
{
    public function create(){
        return view('usuarios.login');
    }

    public function store(Request $request){
        $usuario = new User;

        $usuario->nome = $request->nome;
        $usuario->cpf = $request->cpf;
        $usuario->email = $request->email;

            if($request->senha){
                $usuario->senha = md5($request->senha);
            }

        $usuario->tipo = 'user';

        $usuario->save();

        return redirect('/');

    }
}
