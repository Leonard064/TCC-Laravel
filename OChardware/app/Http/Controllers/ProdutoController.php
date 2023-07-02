<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Produto;
use App\Models\Pedido;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Avaliacao;
use App\Models\Prod_Vendido;

use Auth;

class ProdutoController extends Controller
{

    /* -- chamada de páginas -- */

    //PÁGINA INDEX
    public function index(){

        //Promoções do momento
        $produtoValor = Produto::orderBy('preco' , 'ASC')->take(8)->get();

        //Acabaram de Chegar
        $produtoTempo = Produto::orderBy('created_at', 'DESC')->take(4)->get();


        return view('index',['produtoValor' => $produtoValor , 'produto' => $produtoTempo]);
    }

    public function showAlertaRemove($id){

        if(\Auth::check()){
            if(\Auth::user()->tipo == 'adm'){
                return view('produtos.aviso-remove',['id_produto' => $id]);

            }
        }

        return redirect('/');

    }

    //PÁGINA DE CRIAÇÃO DE PRODUTOS
    public function create(){

        if(Auth::check()){
            // somente Admin pode acessar a pág.
            if(\Auth::user()->tipo == 'adm'){
                $categoria = Categoria::all();
                $marca = Marca::all();

                return view('produtos.create', ['categoria' => $categoria ,'marca' => $marca]);

            }
        }

        return redirect('/');

    }


    public function showEditProduto($id){

        if(Auth::check()){
            if(Auth::user()->tipo == 'adm'){
                try{
                    $produto = Produto::findOrFail($id);
                    $categoria = Categoria::all();
                    $marca = Marca::all();

                    return view('produtos.edit-produto', ['produto' => $produto , 'categoria' => $categoria ,'marca' => $marca]);

                } catch (\Throwable $th) {

                    echo $th->getMessage();
                }

            }
        }

        return redirect('/');

    }


    //Página de Categorias / Pesquisa
    public function showProdutos($id_categoria = 0){
        $pesquisa = request('pesquisa');
        $marca = Marca::all();

        //checa se foi inserido algo na pesquisa...
        if($pesquisa){

            $produto = Produto::where('nome','like','%'.$pesquisa.'%')->get();
            $categoria = Categoria::all();
            $categoriaBE = $categoria; //exclusivo para busca específica

        //...caso não, checa se há categoria selecionada
        }elseif($id_categoria != 0){

            $pesquisa = 0;
            $produto = Produto::where('id_categoria', $id_categoria)->get();
            $categoria = Categoria::where('id', $id_categoria)->get();
            $categoriaBE = Categoria::all();

        //Caso nada, mantém na mesma página
        }else{
            return redirect()->back();
        }

        return view('produtos', ['produto' => $produto, 'marca' => $marca, 'categoriaBE' => $categoriaBE, 'categoria' => $categoria, 'pesquisa' => $pesquisa]);

    }



    //Página Detalhes
    public function show($id){
        $produto = Produto::findOrFail($id);

        $avaliacao = Avaliacao::where('id_produto', $id)
                                ->join('usuarios','avaliacoes.id_usuario', '=', 'usuarios.id')
                                ->select('avaliacoes.*','usuarios.nome','usuarios.sobrenome')
                                ->get();


        $checaCompra = 0;

        if(\Auth::check()){
            // $checaCompra = Pedido::where('id_usuario', \Auth::user()->id)->get();

            if(Pedido::where('id_usuario', \Auth::user()->id)->exists()){
                $checaCompra = 1;
            }

        }

        return view('produtos.show',['produto' => $produto, 'checaCompra'=> $checaCompra,'avaliacao' => $avaliacao]);

    }


    /*
        pesquisa os itens que se encaixam na seleção do usuário
    */
    public function pesquisaProdutos(Request $request){

        if(is_null($request->valorMin) && is_null($request->valorMax)){
            $produto = Produto::where('id_marca' , '=' , $request->marca)
                                ->where('id_categoria', '=', $request->categoria)
                                ->get();

        }else{
            if(!is_null($request->valorMin) && !is_null($request->valorMax)){
                $valMin = $request->valorMin;
                $valMax = $request->valorMax;
            }

            if(is_null($request->valorMin) && !is_null($request->valorMax)){
                $valMin = 0;
                $valMax = $request->valorMax;
            }

            if(is_null($request->valorMax) && !is_null($request->valorMin)){
                $valMax = 0;
                $valMin = $request->valorMin;
            }

            $produto = Produto::where('id_marca' , '=' , $request->marca)
                                ->where('id_categoria', '=', $request->categoria)
                                ->where('preco', '>=', $valMin)
                                ->where('preco', '<=', $valMax)
                                ->get();

         }


        //para evitar crashes, marca e categoria precisam ser enviados

        $marca = Marca::all();
        $categoria = Categoria::where('id', $request->categoria)->get();
        $categoriaBE = Categoria::all();
        $pesquisa = 0;

        return view('produtos', ['produto' => $produto, 'marca' => $marca, 'categoria' => $categoria, 'categoriaBE' => $categoriaBE, 'pesquisa' => $pesquisa]);
    }


    //Chamadas CRUD

    //Criar Produto
    public function store(Request $request){

        $valida = Validator::make($request->all(),[
            'nome' => 'required|min:5|max:255',
            'id_categoria' => 'required',
            'id_marca' => 'required',
            'preco' => 'required|numeric|between:0.10,99999999.99', //até 99 milhões
            'descricao' => 'required|min:10',
            'foto' => 'required|mimes:jpg,png,bmp,jpeg|max:10240',
            'largura' => 'required|numeric|between:0.1,10000', //até 100 metros
            'altura' => 'required|numeric|between:0.1,10000', //até 100 metros
            'peso' => 'required|numeric|between:0.1,999', //até 999 kilos
            'comprimento' => 'required|numeric|between:0.1,10000', //até 100 metros
            'quantidade' => 'required|numeric|between:1,9999999', // até 9.99 milhões
        ],[
            'required'      => 'Campo :attribute não pode estar vazio.',
            'min'           => ':attribute não contempla valor mínimo.',
            'foto.mimes'    => 'Insira uma imagem válida',
            'between'       => 'Valor inserido não aceito',
            'numeric'       => 'Apenas números são aceitos'
        ]);

        if($valida->fails()){
            return redirect('/create-produto')
                            ->withErrors($valida);
        }else{
            $valores = $valida->validate();
            $produto = new Produto;

            // $produto->nome = $request->nome;
            // $produto->categoria = $request->categoria;
            // $produto->preco = $request->preco;
            // $produto->descricao = $request->descricao;

            $produto->fill($valores);

                if($request->hasFile('foto') && $request->file('foto')->isValid()){
                    $requestImage = $request->foto;
                    $extensao = $requestImage->extension();
                    $nomeFoto = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extensao;

                    $requestImage->move(public_path('img/produtos'),$nomeFoto);

                    $produto->foto = $nomeFoto;
                }else{
                    return 0;
                }

                    try {

                        $produto->save();

                        $request->session()->flash('ok','Produto adicionado com sucesso.');
                        return redirect('/');

                    } catch (\Exception $e) {

                        echo $e->getMessage();

                    }

        }



    }


    //Remover Produtos (Dashboard ADM)
    public function removerProduto($id){

        if(Auth::check()){
            if(Auth::user()->tipo == 'adm'){
                try {

                    if(Produto::destroy($id)) {
                        return redirect('/dashboard')->with('ok','Item excluído com sucesso');
                    }else{
                        return redirect('/dashboard')->with('err','Item não foi excluído');
                    }

                } catch (\Throwable $th) {

                    echo $th->getMessage();

                }

            }
        }

        return redirect('/');

    }


    //Editar Produtos
    public function updateProduto(Request $request){

        if(Auth::check()){
            if(Auth::user()->tipo == 'adm'){
                $valida = Validator::make($request->all(),[
                    'nome' => 'required|min:5|max:255',
                    'id_categoria' => 'required',
                    'id_marca' => 'required',
                    'preco' => 'required|numeric|between:0.10,99999999.99', //até 99 milhões
                    'descricao' => 'required|min:10',
                    'foto' => 'mimes:jpg,png,bmp,jpeg|max:10240',
                    'largura' => 'required|numeric|between:0.1,10000', //até 100 metros
                    'altura' => 'required|numeric|between:0.1,10000', //até 100 metros
                    'peso' => 'required|numeric|between:0.1,999', //até 999 kilos
                    'comprimento' => 'required|numeric|between:0.1,10000', //até 100 metros
                    'quantidade' => 'required|numeric|between:1,9999999', // até 9.99 milhões
                ],[
                    'required' => 'Campo :attribute não pode estar vazio.',
                    'min' => ':attribute não contempla valor mínimo.',
                    'foto.mimes' => 'Insira uma imagem válida',
                    'between'       => 'Valor inserido não aceito',
                    'numeric'       => 'Apenas números são aceitos'
                ]);

                if($valida->fails()){
                    return redirect()
                                ->back()
                                ->withErrors($valida)
                                ->withInput();
                }else{

                    try {

                        $produto = Produto::find($request->id);

                        $valores = $valida->validated();

                        $produto->nome         = $valores['nome'];
                        $produto->id_categoria = $valores['id_categoria'];
                        $produto->id_marca     = $valores['id_marca'];
                        $produto->preco        = $valores['preco'];
                        $produto->descricao    = $valores['descricao'];

                        if($request->hasFile('foto') && $request->file('foto')->isValid()){

                            $requestImage = $request->foto;
                            $extensao = $requestImage->extension();
                            $nomeFoto = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extensao;

                            $requestImage->move(public_path('img/produtos'),$nomeFoto);

                            $produto->foto = $nomeFoto;

                        }

                        $produto->largura      = $valores['largura'];
                        $produto->altura       = $valores['altura'];
                        $produto->peso         = $valores['peso'];
                        $produto->comprimento  = $valores['comprimento'];
                        $produto->quantidade   = $valores['altura'];



                        $produto->save();

                        return redirect('/dashboard')->with('ok','Produto Atualizado com Sucesso.');

                    } catch (\Throwable $th) {

                        echo $th->getMessage();

                    }

                }

            }
        }

        return redirect('/');

    }

}

