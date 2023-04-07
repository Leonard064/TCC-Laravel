@extends('layouts.main')

@section('title','Editar Produto')

@section('conteudo')
    <section class="flex-container corpo flex-form">
        <div class="grid-container form-creation bg-gray margin-new padding-detalhes border-10">

            <h1>Editar Produto</h1>
            <form action="/update-produto" method="POST" enctype="multipart/form-data" class="form-50">
                @csrf

                <input type="text" name="nome" id="nome" placeholder="nome" class="input-full" value="{{$produto->nome}}"><br>

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


                <input type="text" name="preco" id="preco" placeholder="Preço" class="input-full" value = "{{$produto->preco}}"><br>

                <label for="descricao">Descrição: </label><br>
                <textarea name="descricao" id="descricao" cols="80" rows="10">{{$produto->descricao}}</textarea>
                <br>
                <label for="foto">Imagem: (Foto Atual: {{$produto->foto}})</label><br>
                <input type="file" name="foto" id="foto">
                <br>
                <input type="text" name="largura" id="largura" placeholder="largura" class="input-full" value="{{$produto->largura}}">
                <input type="text" name="altura" id="altura" placeholder="altura" class="input-full" value="{{$produto->altura}}">
                <input type="text" name="peso" id="peso" placeholder="peso" class="input-full" value="{{$produto->peso}}">
                <input type="text" name="comprimento" id="comprimento" placeholder="comprimento" class="input-full" value="{{$produto->comprimento}}">
                <input type="text" name="quantidade" id="quantidade" placeholder="quantidade" class="input-full" value="{{$produto->quantidade}}">

                <input type="hidden" name="id" value="{{$produto->id}}">

                <div class="flex-container form">
                    <button class="bt-red">Atualizar</button>
                </div>

            </form>

        </div>

    </section>

@endsection
