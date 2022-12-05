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

        $produto = Produto::all();

        return view('index',['produto' => $produto]);
    }

    public function create(){

        $categoria = Categoria::all();
        $marca = Marca::all();

        return view('produtos.create', ['categoria' => $categoria ,'marca' => $marca]);
    }


    //chamadas CRUD
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


}

