@extends('layouts.main')

@section('title','Editar Produto')

@section('conteudo')
    <section class="flex-container corpo flex-form">

        <div class="grid-container auth bg-gray border-10">
            <div class="flex-container form">
                <h2>Editar Produto</h2>
                <form action="/update-produto" method="POST" enctype="multipart/form-data" class="grid-container form-cadastro">
                    @csrf
                    <div class="span-2">
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Nome" class="input-full" value="{{$produto->nome}}"><br>
                        @if ($errors->get('nome'))
                            @foreach ($errors->get('nome') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div>
                        <label for="categoria">Categoria:</label>

                            @if(count($categoria)>0)

                                <select name="id_categoria" id="id_categoria" class="input-full">
                                    @foreach ($categoria as $categorias)
                                        <option value="{{$categorias->id}}" name="">{{$categorias->nome}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->get('id_categoria'))
                                    @foreach ($errors->get('id_categoria') as $err)
                                        <p class="err-form">{{$err}}</p><br>
                                    @endforeach

                        @endif


                            @else
                                <h3>Não há categorias</h3>
                            @endif
                    </div>

                    <div>
                        <label for="marca">Marca:</label>
                            @if(count($marca)>0)

                            <select name="id_marca" id="id_marca" class="input-full">
                                @foreach ($marca as $marcas)
                                    <option value="{{$marcas->id}}">{{$marcas->nome}}</option>
                                @endforeach

                                @if ($errors->get('id_marca'))
                                    @foreach ($errors->get('id_marca') as $err)
                                        <p class="err-form">{{$err}}</p><br>
                                    @endforeach

                                @endif

                            </select>
                            @else
                            <h3>Não há marcas</h3>
                            @endif
                    </div>

                    <div class="span-2-mb-only">
                        <label for="preco">Preço:</label>
                        <input type="text" name="preco" id="preco" placeholder="Preço" class="input-full" value="{{$produto->preco}}">
                        @if ($errors->get('preco'))
                            @foreach ($errors->get('preco') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div class="span-2">
                        <label for="descricao">Descrição:</label>
                        <textarea name="descricao" id="descricao">{{$produto->descricao}}"</textarea>
                        @if ($errors->get('descricao'))
                            @foreach ($errors->get('descricao') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div class="span-2">
                        <label for="foto">Imagem: </label>
                        <p>Atual:</p>
                        <img src="../img/produtos/{{$produto->foto}}" class="img-edit" alt="foto">
                        <input type="hidden" name="fotoAtual" value="{{$produto->foto}}">
                        <input type="file" name="foto" id="foto">
                        @if ($errors->get('foto'))
                            @foreach ($errors->get('foto') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div class="span-2-mb-only">
                        <label for="largura">Largura (em cm):</label>
                        <input type="text" name="largura" id="largura" placeholder="Largura (cm)" class="input-full" value = "{{$produto->largura}}")>
                        @if ($errors->get('largura'))
                            @foreach ($errors->get('largura') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div class="span-2-mb-only">
                        <label for="altura">Altura (em cm):</label>
                        <input type="text" name="altura" id="altura" placeholder="Altura (cm)" class="input-full" value = "{{$produto->altura}}">
                        @if ($errors->get('altura'))
                            @foreach ($errors->get('altura') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div class="span-2-mb-only">
                        <label for="peso">Peso (em Kgs):</label>
                        <input type="text" name="peso" id="peso" placeholder="Peso (kg)" class="input-full" value = "{{$produto->peso}}">
                        @if ($errors->get('peso'))
                            @foreach ($errors->get('peso') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div class="span-2-mb-only">
                        <label for="comprimento">Comprimento (em cm):</label>
                        <input type="text" name="comprimento" id="comprimento" placeholder="Comprimento (cm)" class="input-full" value = "{{$produto->comprimento}}">
                        @if ($errors->get('comprimento'))
                            @foreach ($errors->get('comprimento') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div class="span-2-mb-only">
                        <label for="quantidade">Quantidade:</label>
                        <input type="text" name="quantidade" id="quantidade" placeholder="Quantidade" class="input-full" value = "{{$produto->quantidade}}">
                        @if ($errors->get('quantidade'))
                            @foreach ($errors->get('quantidade') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <input type="hidden" name="id" value="{{$produto->id}}">

                    <div class="flex-container bt-auth span-2">
                        <button class="bt-red">Atualizar</button>
                    </div>
                </form>

            </div>
        </div>

        {{-- <div class="grid-container form-creation bg-gray margin-new padding-detalhes border-10">

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

        </div> --}}

    </section>

@endsection
