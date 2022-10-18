<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ProdutoController extends Controller
{

    //chamada de páginas
    public function index(){

        $produto = Produto::all();

        return view('index',['produto' => $produto]);
    }

    public function create(){
        return view('produtos.create');
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
            //throw $th;
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

    public function showProdutos($categoria = 0){
        $pesquisa = request('pesquisa');

        if($pesquisa){
            $result = 0;

            $produto = Produto::where('nome','like','%'.$pesquisa.'%')->get();
        }elseif($categoria){
            $pesquisa = 0;
            $produto = Produto::where('categoria', $categoria)->get();

            switch($categoria){
                case 'processador':
                    $result = 'Processadores';
                    break;
                case 'placa_mae':
                    $result = 'Placas-Mãe';
                    break;
                case 'placa_de_video':
                    $result = 'Placas de Vídeo';
                    break;
                case 'memoria':
                    $result = 'Memórias';
                    break;
                case 'monitor':
                    $result = 'Monitores';
                    break;
                case 'mouse_teclado':
                    $result = 'Mouse e Teclado';
                    break;
                case 'hd':
                    $result = 'HDs';
                    break;
                case 'ssd':
                    $result = 'SSDs';
                    break;
                case 'fonte':
                    $result = 'Fontes';
                    break;
            }


        }else{
            return 0;
        }

        return view('produtos', ['produto' => $produto, 'categoria' => $result, 'pesquisa' => $pesquisa]);

    }

    public function show($id){
        $produto = Produto::findOrFail($id);

        return view('produtos.show',['produto' => $produto]);

    }


}

