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

class ProdutoController extends Controller
{

    /* -- chamada de páginas -- */

    //PÁGINA INDEX
    public function index(){

        //Promoções do momento
        $produtoValor = Produto::orderBy('preco' , 'ASC')->get();

        //Acabaram de Chegar
        $produtoTempo = Produto::orderBy('created_at', 'DESC')->take(4)->get();


        return view('index',['produtoValor' => $produtoValor , 'produto' => $produtoTempo]);
    }


    //PÁGINA DE CRIAÇÃO DE PRODUTOS
    public function create(){

        // somente Admin pode acessar a pág.
        if(\Auth::user()->tipo == 'adm'){
            $categoria = Categoria::all();
            $marca = Marca::all();

            return view('produtos.create', ['categoria' => $categoria ,'marca' => $marca]);

        }

        return redirect('/');

    }


    public function showEditProduto($id){

        try{
            $produto = Produto::findOrFail($id);
            $categoria = Categoria::all();
            $marca = Marca::all();

            return view('produtos.edit-produto', ['produto' => $produto , 'categoria' => $categoria ,'marca' => $marca]);

        } catch (\Throwable $th) {

            echo $th->getMessage();
        }

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


    //página Todos os Produtos (Dashboard ADM)
    public function showAdmProdutos(){
        $produto = Produto::all();

        return view('produtos.showAdmProdutos', ['produto' => $produto]);
    }


    /*pesquisa os itens que se encaixam na seleção do usuário
        ---- em construção ----
    */
    public function pesquisaProdutos(Request $request){

        $produto = Produto::where('id_marca' , '=' , $request->marca)
                            ->where('id_categoria', '=', $request->categoria)
                            ->where('preco', '>=', $request->valorMin)
                            ->where('preco', '<=', $request->valorMax)
                            ->get();


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
            'nome' => 'required|min:5',
            'id_categoria' => 'required',
            'id_marca' => 'required',
            'preco' => 'required|min:3',
            'descricao' => 'required|min:10',
            'foto' => 'required|mimes:jpg,png,bmp,jpeg|max:10240',
            'largura' => 'required|min:1',
            'altura' => 'required|min:1',
            'peso' => 'required|min:1',
            'comprimento' => 'required|min:1',
            'quantidade' => 'required|min:1',
        ],[
            'required' => 'Campo :attribute não pode estar vazio.',
            'min' => ':attribute não contempla valor mínimo.',
            'foto.mimes' => 'Insira uma imagem válida'
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


    //Editar Produtos
    public function updateProduto(Request $request){

        $valida = Validator::make($request->all(),[
            'nome' => 'required|min:5',
            'id_categoria' => 'required',
            'id_marca' => 'required',
            'preco' => 'required|min:3',
            'descricao' => 'required|min:10',
            'foto' => 'required|mimes:jpg,png,bmp,jpeg|max:10240',
            'largura' => 'required|min:1',
            'altura' => 'required|min:1',
            'peso' => 'required|min:1',
            'comprimento' => 'required|min:1',
            'quantidade' => 'required|min:1',
        ],[
            'required' => 'Campo :attribute não pode estar vazio.',
            'min' => ':attribute não contempla valor mínimo.',
            'foto.mimes' => 'Insira uma imagem válida'
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
                $produto->largura      = $valores['largura'];
                $produto->altura       = $valores['altura'];
                $produto->peso         = $valores['peso'];
                $produto->comprimento  = $valores['comprimento'];
                $produto->quantidade   = $valores['altura'];


                if($request->hasFile('foto') && $request->file('foto')->isValid()){

                    $requestImage = $request->foto;
                    $extensao = $requestImage->extension();
                    $nomeFoto = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extensao;

                    $requestImage->move(public_path('img/produtos'),$nomeFoto);

                    $produto->foto = $nomeFoto;

                }

                $produto->save();

                return redirect('/dashboard')->with('ok','Produto Atualizado com Sucesso.');

            } catch (\Throwable $th) {

                echo $th->getMessage();

            }

        }


    }

}

