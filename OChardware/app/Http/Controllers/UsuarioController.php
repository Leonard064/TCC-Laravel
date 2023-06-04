<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use App\Models\Pedido;
use App\Models\Produto;
use DB;

class UsuarioController extends Controller
{

    /* ==  CHAMADA DE PÁGINAS  == */

    //TELA DE LOGIN
    public function showLogin(){
        return view('usuarios.login');
    }


    //TELA DE CADASTRO
    public function showCadastre(){

        return view('usuarios.cadastre-se');

    }


    //PÁGINA PERFIL - USUARIO
    public function perfil(){

        $pedidos = Pedido::where('id_usuario', \Auth::user()->id)->take(5)->get();

        return view('usuarios.perfil', ['pedidos' => $pedidos]);
    }

    public function showUserPedidos(){
        $pedidos = Pedido::where('id_usuario', \Auth::user()->id)
                                                            ->orderBy('created_at', 'DESC')
                                                            ->get();

        return view('pedidos.showUserPedidos', ['pedidos' => $pedidos]);
    }


    //TELA DE ATUALIZAR PERFIL
    public function showEditPerfil(){

        try{
            $usuario = Usuario::findOrFail(\Auth::user()->id);

            return view('usuarios.editar-perfil', ['usuario' => $usuario]);

        }catch (\Throwable $th) {

            echo $th->getMessage();

        }

    }


    //TELA DE ALTERAR SENHA
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


    //PÁGINA ADMIN
    public function dashboard(){
        if(\Auth::user()->tipo == 'adm'){

            $pedidos = Pedido::orderBy('created_at', 'DESC')->get()->take(5);
            $produtos = Produto::orderBy('created_at', 'DESC')->get()->take(5);

            return view('usuarios.dashboard', ['pedidos' => $pedidos, 'produtos' => $produtos]);

        }else{
            return redirect('/');
        }

    }


    /* ==  CHAMADAS CRUD  == */

    //cadastro de usuário
    public function store(Request $request){

        $valida = Validator::make($request->all(),[
            'login' => 'required|unique:usuarios|min:5',
            'nome' => 'required|min:4',
            'sobrenome' => 'required|min:4',
            'cpf' => 'required|unique:usuarios|cpf',
            'email' => 'required|unique:usuarios|min:7|email',
            'foto' => 'mimes:jpg,png,bmp,jpeg|max:10240',
            'senha' => 'required|unique:usuarios|min:6',
            'teste-senha' => 'required|same:senha',
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
            'unique' => ':attribute já foi cadastrado, tente outro.',
            'min' => 'Campo :attribute menor que o valor esperado.',
            'max' => 'Campo :attribute maior que o valor esperado.',
            'same' => 'Senhas digitadas não são iguais',
            'numeric' => 'Apenas números são aceitos.',
            'email' => 'Email inserido não é válido',
            'foto.mimes' => 'Insira uma imagem válida',
            'cpf' => 'CPF inserido não é valido',
        ]);

        if ($valida->fails()) {
            return redirect('/cadastre-se')
                        ->withErrors($valida)
                        ->withInput();

        }else{
            $valores = $valida->validated();

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

    }


    //login de usuário
    public function authenticate(Request $request){

        $valida = Validator::make($request->all(),[
            'login' => 'required',
            'senha' => 'required',
        ],[
            'required' => 'Campo :attribute está vazio.',
        ]);

        if ($valida->fails()) {
            return redirect('/login')->withErrors($valida);

        } else {
            $valores = $valida->validated();

            $login = $valores['login'];
            $senha = $valores['senha'];

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

    }


    //logout de usuário
    public function logout(Request $request){

        Auth::logout();

        $request->session()->flash('ok','Usuário deslogado com sucesso');
        return redirect('/');
    }


    //Editar Cadastro
    public function updatePerfil(Request $request){

        $valida = Validator::make($request->all(),[
            'login' => 'required|min:5',
            'nome' => 'required|min:4',
            'sobrenome' => 'required|min:4',
            'email' => 'required|min:7|email',
            'foto' => 'mimes:jpg,png,bmp,jpeg|max:10240',
        ],
        [
            'required' => 'Campo :attribute não pode estar vazio.',
            'unique' => ':attribute já está em uso. tente outro.',
            'min' => 'Campo :attribute menor que o valor esperado.',
            'max' => 'Campo :attribute maior que o valor esperado.',
            'email' => 'Email inserido não é válido',
            'foto.mimes' => 'Insira uma imagem válida',
        ]);

        if ($valida->fails()) {
            return redirect('/editar-perfil')
                        ->withErrors($valida)
                        ->withInput();
        } else {
            try {
                $usuario = Usuario::find(\Auth::user()->id);

                $valores = $valida->validated();

                $usuario->login = $valores['login'];
                $usuario->nome = $valores['nome'];
                $usuario->sobrenome = $valores['sobrenome'];
                $usuario->email = $valores['email'];

                if($request->hasFile('foto') && $request->file('foto')->isValid()){

                    $requestImage = $request->foto;
                    $extensao = $requestImage->extension();
                    $nomeFoto = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extensao;

                    $requestImage->move(public_path('img/usuarios'),$nomeFoto);

                    $usuario->foto = $nomeFoto;

                }

                $usuario->save();

                $request->session()->flash('ok','Dados alterados com sucesso');
                return redirect('/perfil');

            } catch (\Throwable $th) {

                echo $th->getMessage();

            }
        }

    }


    public function updateSenha(Request $request){
        $valida = Validator::make($request->all(),[
            'senha' => 'required',
            'senha-nova' => 'required|min:6',
        ],
        [
            'required' => 'O campo não pode estar vazio.',
            'min' => 'Senha possui menos de 6 caracteres.',
        ]);

        if ($valida->fails()) {
            return back()
                    ->withErrors($valida)
                    ->withInput();
        } else {

            $valores = $valida->validated();

            // checa se senha atual foi inserida corretamente
            if(Hash::check($valores['senha'], \Auth::user()->senha)){

                // checa se ambas senhas não são iguais
                if(strcmp($valores['senha'],$valores['senha-nova']) == 0){
                    return back()->with('error','ERRO - Essa já é sua senha.');
                }

                try {
                    $usuario = Usuario::find(\Auth::user()->id);

                    $valores = $valida->validated();

                    $usuario->senha = Hash::make($valores['senha-nova']);

                    $usuario->save();

                    $request->session()->flash('ok','Senha alterada com sucesso');
                    return redirect('/perfil');

                } catch (\Throwable $e) {
                    echo $e->getMessage();

                    $request->session()->flash('err','Não foi possível alterar a senha');
                }

            }else{
                $request->session()->flash('error','ERRO - Senha atual invalida.');
                return redirect('/alterar-senha');
            }

        }
    }
}
