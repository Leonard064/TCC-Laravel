<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Pedido;
use App\Models\Produto;
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

        $pedidos = Pedido::where('id_usuario', \Auth::user()->id)->take(5)->get();

        return view('usuarios.perfil', ['pedidos' => $pedidos]);
    }

    public function showUserPedidos(){
        $pedidos = Pedido::where('id_usuario', \Auth::user()->id)->get();

        return view('pedidos.showUserPedidos', ['pedidos' => $pedidos]);
    }


    public function showEditPerfil(){

        try{
            $usuario = Usuario::findOrFail(\Auth::user()->id);

            return view('usuarios.editar-perfil', ['usuario' => $usuario]);

        }catch (\Throwable $th) {

            echo $th->getMessage();

        }

    }

    public function showAlterarSenha(){
        try{
            if(Usuario::findOrFail(\Auth::user()->id)){
                return view('usuarios.alterar-senha');
            }else{
                return redirect('/');
            }

        }catch (\Throwable $th) {

            echo $th->getMessage();

        }
    }

    public function dashboard(){
        if(\Auth::user()->tipo == 'adm'){

            $pedidos = Pedido::all()->take(5);
            $produtos = Produto::all()->take(5);

            return view('usuarios.dashboard', ['pedidos' => $pedidos, 'produtos' => $produtos]);

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

            /* Checa se o usuário especificou uma foto no ato de cadastro */
            if($request->hasFile('foto') && $request->file('foto')->isValid()){

                $requestImage = $request->foto;
                $extensao = $requestImage->extension();
                $nomeFoto = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extensao;

                $requestImage->move(public_path('img/usuarios'),$nomeFoto);

                $usuario->foto = $nomeFoto;

            }else{ //caso não, ele salvará a foto "default"

               $usuario->foto = 'foto-padrao.png';

            }


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

                        //chama a função de login - e manda os campos preenchidos no cadastro
                        return $this->authenticate($request);

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


    //Editar Cadastro
    public function updatePerfil(Request $request){

        try {
            $usuario = Usuario::find(\Auth::user()->id);

            $usuario->nome = $request->nome;
            $usuario->sobrenome = $request->sobrenome;

            if($request->hasFile('foto') && $request->file('foto')->isValid()){

                $requestImage = $request->foto;
                $extensao = $requestImage->extension();
                $nomeFoto = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extensao;

                $requestImage->move(public_path('img/usuarios'),$nomeFoto);

                $usuario->foto = $nomeFoto;

            }

            $usuario->save();

            return redirect('/perfil');

        } catch (\Throwable $th) {

            echo $th->getMessage();

        }
    }
}
