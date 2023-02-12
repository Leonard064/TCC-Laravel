<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Usuario;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Avaliacao;

class ProdutoController extends Controller
{

    //chamada de páginas
    public function index(){

        //Promoções do momento
        $produtoValor = Produto::orderBy('preco' , 'ASC')->get();

        //Acabaram de Chegar
        $produtoTempo = Produto::all();


        return view('index',['produtoValor' => $produtoValor , 'produto' => $produtoTempo]);
    }


    public function create(){

        $categoria = Categoria::all();
        $marca = Marca::all();

        return view('produtos.create', ['categoria' => $categoria ,'marca' => $marca]);
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

        if($pesquisa){

            $produto = Produto::where('nome','like','%'.$pesquisa.'%')->get();
            $categoria = Categoria::all();

        }elseif($id_categoria){

            $pesquisa = 0;
            $produto = Produto::where('id_categoria', $id_categoria)->get();
            $categoria = Categoria::where('id', $id_categoria)->get();

        }else{
            return 0;
        }

        return view('produtos', ['produto' => $produto, 'marca' => $marca, 'categoria' => $categoria, 'pesquisa' => $pesquisa]);

    }



    //Página Detalhes
    public function show($id){
        $produto = Produto::findOrFail($id);

        $avaliacao = Avaliacao::where('id_produto', $id)
                                ->join('usuarios','avaliacoes.id_usuario', '=', 'usuarios.id')
                                ->select('avaliacoes.*','usuarios.nome','usuarios.sobrenome')
                                ->get();

        // $teste = [];

        // foreach($avaliacao as $avaliacoes){
        //     array_push($teste, Usuario::where('id', $avaliacoes->id_usuario)->pluck('nome'));
        // }


        return view('produtos.show',['produto' => $produto, 'avaliacao' => $avaliacao]);

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

        //pega o radio selecionado e limita um valor a ele
        if($request->valor == 'baixo'){
            $valor = 100.0;
        }else if($request->valor == 'medio'){
            $valor = 500.0;
        }else if($request->valor == 'alto' || $request->valor == 'caro'){
            $valor = 1000.0;
        }

        $produto = Produto::where('marcas' , '=' , $request->marca)
                            ->where('categorias', '=', $request->categoria)
                            ->where('valor', '<', $valor)
                            ->get();


        //para evitar crashes, marca e categoria precisam ser enviados

        $marca = Marca::all();
        $categoria = Categoria::all();

        return view('produtos', ['produto' => $produto, 'marca' => $marca, 'categoria' => $categoria]);
    }


    //Chamadas CRUD

    //Criar Produto
    public function store(Request $request){

        $valores = $request->all();
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
                    return redirect('/');

                } catch (\Exception $e) {

                    echo $e->getMessage();

                }

    }

    // public function showPesquisa(){

    //     $pesquisa = request('pesquisa');

    //     if($pesquisa){
    //         $produto = Produto::where('nome','like','%'.$pesquisa.'%')->get();
    //     }else{
    //         return 0;
    //     }
    //     return view('produtos',['produto' => $produto, 'pesquisa' => $pesquisa]);

    // }

    // public function showCat($categoria){

    //     $pesquisa = 0;

    //     if($categoria){
    //         $produto = Produto::where('categoria', $categoria)->get();
    //     }else{
    //         $produto = Produto::all();
    //     }
    //     return view('produtos', ['produto' => $produto, 'categoria' => $categoria, 'pesquisa' => $pesquisa]);
    // }


    //Remover Produtos (Dashboard ADM)
    public function removerProduto($id){

        try {

            if(Produto::destroy($id)) {
                return redirect('/dashboard')->session()->flash('ok','Item Excluído');
            }else{
                return redirect('/dashboard')->session()->flash('err','Item não foi excluído');
            }

        } catch (\Throwable $th) {

            echo $th->getMessage();

        }
    }


    //Editar Produtos
    public function updateProduto(Request $request){

        try {

            $produto = Produto::find($request->id);

            $produto->nome = $request->nome;
            $produto->id_categoria = $request->id_categoria;
            $produto->id_marca = $request->id_marca;
            $produto->preco = $request->preco;
            $produto->descricao = $request->descricao;
            $produto->largura = $request->largura;
            $produto->altura = $request->altura;
            $produto->peso = $request->peso;
            $produto->comprimento = $request->comprimento;
            $produto->quantidade = $request->quantidade;


            if($request->hasFile('foto') && $request->file('foto')->isValid()){

                $requestImage = $request->foto;
                $extensao = $requestImage->extension();
                $nomeFoto = md5($requestImage->getClientOriginalName().strtotime('now')).'.'.$extensao;

                $requestImage->move(public_path('img/usuarios'),$nomeFoto);

                $produto->foto = $nomeFoto;

            }

            $produto->save();

            return redirect('/dashboard');

        } catch (\Throwable $th) {

            echo $th->getMessage();

        }

    }

}

