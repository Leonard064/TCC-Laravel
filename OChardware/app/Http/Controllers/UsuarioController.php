<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Pedido;
use DB;

class UsuarioController extends Controller
{

    //chamadas de páginas

    public function showLogin(){
        return view('usuarios.login');
    }

    public function showCadastre(){
        return view('usuarios.cadastre-se');
    }

    public function perfil(){

        $pedidos = Pedido::where('id_usuario', \Auth::user()->id)->get();

        return view('usuarios.perfil', ['pedidos' => $pedidos]);
    }

    public function dashboard(){
        if(\Auth::user()->tipo == 'adm'){

            $pedidos = Pedido::all();

            return view('usuarios.dashboard', ['pedidos' => $pedidos]);

        }else{
            return redirect('/');
        }

    }


    //chamadas CRUD

    //cadastro de usuário
    public function store(Request $request){
        $valores = $request->all();

        $usuario = new Usuario;
        $usuario->fill($valores);

        $usuario->senha = Hash::make($request->senha); //criptografa a senha

        $usuario->tipo = 'user'; //todos os cadastros diretos do site são 'users'

        try{

            //checa se já existe um email igual cadastrado no sistema
            $dbUsuario = Usuario::where('login', $usuario->login)->first();
            if($dbUsuario){

                $request->session()->flash('err', 'Credencial já existe no banco.');

            }

                DB::beginTransaction();
                $usuario->save();
                DB::commit();

                return $this->authenticate($request); //chama a função de login - e manda os campos preenchidos no cadastro

        }catch(\Exception $e){

            echo $e->getMessage();
            DB::rollback();

            $request->session()->flash('err', 'Usuário não pode ser cadastrado');
        }

    }


    //login de usuário
    public function authenticate(Request $request){

        $login = $request->input('login');
        $senha = $request->input('senha');

        $credential = ['login' => $login, 'password'=> $senha];

        //tenta logar o usuário
        if(Auth::attempt($credential)){

            if(Auth::user()->tipo == 'user'){
                $request->session()->flash('ok','Usuário logado com sucesso');
                return redirect('/');

            }elseif(Auth::user()->tipo == 'adm') {
                return redirect('/dashboard');
            }

        }else{
            $request->session()->flash('err','ERRO - credenciais inválidas');
            return redirect('/login');
        }
    }


    //logout de usuário
    public function logout(Request $request){

        Auth::logout();

        return redirect('/');
    }

}
