@extends('layouts.main')

@section('title','Editar Produto')

@section('conteudo')
    <section class="flex-container form">
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="text" name="nome" id="nome" placeholder="nome" class="input-full" value="{{$produto->nome}}">

            <label for="categoria">Categoria</label>

                @if(count($categoria)>0)

                    <select name="id_categoria" id="id_categoria" class="input-full">
                        @foreach ($categoria as $categorias)
                            <option value="{{$categorias->id}}" name="">{{$categorias->nome}}</option>
                        @endforeach
                    </select>

                @else
                    <h3>Não há categorias</h3>
                @endif


            <label for="marca">Marca</label>
                @if(count($marca)>0)

                <select name="id_marca" id="id_marca" class="input-full">
                    @foreach ($marca as $marcas)
                        <option value="{{$marcas->id}}">{{$marcas->nome}}</option>
                    @endforeach
                </select>
                @else
                    <h3>Não há marcas</h3>
                @endif


            <input type="text" name="preco" id="preco" placeholder="Preço" class="input-full" value = "{{$produto->preco}}">

            <label for="descricao">Descrição: </label>
            <textarea name="descricao" id="descricao" cols="80" rows="10">{{$produto->descricao}}</textarea>
            <br>
            <label for="foto">Imagem: (Foto Atual: {{$produto->foto}})</label>
            <input type="file" name="foto" id="foto" value="{{$produto->foto}}">
            <br>
            <input type="text" name="largura" id="largura" placeholder="largura" class="input-full" value="{{$produto->largura}}">
            <input type="text" name="altura" id="altura" placeholder="altura" class="input-full" value="{{$produto->altura}}">
            <input type="text" name="peso" id="peso" placeholder="peso" class="input-full" value="{{$produto->peso}}">
            <input type="text" name="comprimento" id="comprimento" placeholder="comprimento" class="input-full" value="{{$produto->comprimento}}">
            <input type="text" name="quantidade" id="quantidade" placeholder="quantidade" class="input-full" value="{{$produto->quantidade}}">

            <button class="bt-red">Atualizar</button>
        </form>
    </section>
@endsection