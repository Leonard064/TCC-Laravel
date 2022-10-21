<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use DB;

class UsuarioController extends Controller
{

    //chamadas de páginas

    public function create(){
        return view('usuarios.login');
    }

    public function perfil(){
        return view('usuarios.perfil');
    }

    public function dashboard(){
        return view('usuarios.dashboard');
    }


    //chamadas CRUD

    public function store(Request $request){
        $valores = $request->all();

        $usuario = new Usuario;
        $usuario->fill($valores);

        $usuario->senha = Hash::make($request->senha);

        $usuario->tipo = 'user';

        try{

            //checa se já existe um email igual cadastrado no sistema
            $dbUsuario = Usuario::where('login', $usuario->login)->first();
            if($dbUsuario){
                $result = ['status' => 'err', 'message' => 'Credencial já existe no banco.'];
            }

            DB::beginTransaction();
            $usuario->save();
            DB::commit();
            $result = ['status' => 'ok', 'message' => 'Usuário cadastrado com sucesso'];

        }catch(\Exception $e){
            Log::error("Erro",['file'=>'UsuarioController.store', 'message'=> $e->getMessage()]);
            DB::rollback();
            $result = ['status' => 'err', 'message' => 'Usuário não pode ser cadastrado'];
        }

        $message = $result['message'];
        $status = $result['status'];

        $request->session()->flash($status, $message);
        return redirect('/');

    }

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

    public function logout(Request $request){
        //logout de usuário
        Auth::logout();

        return redirect('/');
    }

}
