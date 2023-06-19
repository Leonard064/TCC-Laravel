@extends('layouts.main')

@section('title','produto')

@section('conteudo')
    <section class="flex-container corpo-detalhes">
        <section class="detalhes-topo bg-gray border-10 margin-new no-border-sm">
            <div class="grid-container detalhes-foto-nome margin-btm-sm">
                <div class="flex-container detalhes-foto">
                    <img src="../img/produtos/{{$produto->foto}}" class="border-10" alt="OverClock">
                </div>
                <div class="flex-container detalhes-nome">

                    <h1>{{$produto->nome}}</h1>

                    @if($produto->quantidade <= 0)

                        <h3>OPS! Não possuimos estoque desse produto.</h3>

                    @else

                        <hr>
                        <div class="flex-container reverso">
                            <div id="detalhes-preco">
                                @if($produto->quantidade < 500)
                                    <h3>{{$produto->quantidade}} Peças disponíveis, corra!</h3>

                                @else
                                    <h3>Valor Unitário:</h3>

                                @endif
                                <h1 class="label-preco red">R$ {{number_format($produto->preco,2,',','.')}}</h1>
                                {{-- <h4>Valor em pix/ à vista no cartão</h4>
                                <h4>10x de 99,90 sem juros</h4> --}}
                                <form action="/addCarrinho" method="post">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$produto->id}}">
                                    <button class="bt-red">Comprar</button>
                                </form>
                            </div>

                        </div>

                    @endif

                </div>
            </div>
        </section>

        {{-- FIXME - Acertar as divs - precisam ser separadas --}}
        <div class="detalhes-descricao bg-gray border-10 padding-detalhes margin-new no-border-sm">

            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h3>Descrição</h3>
            </div>

            <p>{{$produto->descricao}}</p>
        </div>

            {{-- Se o usuário tiver realizado compras --}}
            @if ($checaCompra == 1)
            <div class="grid-container grid-comentarios-avaliacao margin-new">
                <div class="detalhes-comentarios bg-gray padding-detalhes border-10 no-border-sm">

                    <div class="flex-container topo-secao">
                        <i class="fa-solid fa-square red"></i>
                        <h3>Comentários</h3>
                    </div>


                    @if(count($avaliacao) > 0)
                    <div class="campo-avaliacoes">
                        @foreach ($avaliacao as $avaliacao)
                            <div class="grid-container card-avaliacao">
                                <div class="grid-container grid-center">

                                    @if($avaliacao->gostou)
                                        <i class="fa-solid fa-thumbs-up ico-avaliacao red"></i>
                                    @else
                                        <i class="fa-solid fa-thumbs-down ico-avaliacao red"></i>
                                    @endif

                                </div>
                                <div>
                                    <h4>{{$avaliacao->nome}} {{$avaliacao->sobrenome}}</h4>
                                    <p>{{$avaliacao->texto_avaliacao}}</p>
                                    <hr class="hr-white">
                                </div>

                            </div>
                        @endforeach
                    </div>

                    @else
                        <h4>Ainda não há avaliações para o produto</h4>
                    @endif

                </div>


                    <div class="detalhes-avaliacao bg-gray padding-detalhes border-10 no-border-sm">

                        <div class="flex-container topo-secao">
                            <i class="fa-solid fa-square red"></i>
                            <h3>Gostou do produto?</h3>
                        </div>

                            <form action="/avaliacoes/create" method="post" class="flex-container detalhes-form">
                                @csrf

                                    {{-- manda os ids de cliente e produto --}}
                                    <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
                                    <input type="hidden" name="id_produto" value="{{$produto->id}}">

                                    @if ($errors->get('gostou'))
                                            @foreach ($errors->get('gostou') as $err)
                                                <p class="err-form">{{$err}}</p><br>
                                            @endforeach

                                    @endif

                                    <div class="form-opcoes">
                                        <input type="radio" name="gostou" value="1" >Sim
                                    </div>
                                    <div class="form-opcoes">
                                        <input type="radio" name="gostou" value="0" >Não
                                    </div>

                                    <label for="texto">Deixe sua avaliação: (máx. 100 caracteres)</label>
                                    <textarea name="texto_avaliacao" id="texto" class="border-10" required></textarea>
                                    @if ($errors->get('texto_avaliacao'))
                                        @foreach ($errors->get('texto_avaliacao') as $err)
                                            <p class="err-form">{{$err}}</p><br>
                                        @endforeach

                                    @endif

                                    <button class="bt-red">Enviar</button>

                                </form>

                    </div>

            @else
                <div class="grid-container grid-comentarios margin-new">
                    <div class="detalhes-comentarios bg-gray padding-detalhes border-10 no-border-sm">

                        <div class="flex-container topo-secao">
                            <i class="fa-solid fa-square red"></i>
                            <h3>Comentários</h3>
                        </div>

                        @if(count($avaliacao) > 0)
                            <div class="campo-avaliacoes">
                            @foreach ($avaliacao as $avaliacao)
                                <div class="grid-container card-avaliacao">
                                    <div class="grid-container grid-center">

                                        @if($avaliacao->gostou)
                                            <i class="fa-solid fa-thumbs-up ico-avaliacao red"></i>
                                        @else
                                            <i class="fa-solid fa-thumbs-down ico-avaliacao red"></i>
                                        @endif

                                    </div>
                                    <div>
                                        <h4>{{$avaliacao->nome}} {{$avaliacao->sobrenome}}</h4>
                                        <p>{{$avaliacao->texto_avaliacao}}</p>
                                        <hr class="hr-white">
                                    </div>
                                </div>
                            @endforeach
                            </div>

                        @else
                            <h4>Ainda não há avaliações para o produto</h4>
                        @endif

                    </div>
                </div>
            @endif
  </div>

        {{-- </div> --}}

        {{-- Comentado para evitar possiveis problemas

            <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h3>Descrição</h3>
        </div>
        <div class="detalhes-descricao margem">
            <p>{{$produto->descricao}}</p>
        </div>

        -- comentarios e avaliaçoes

        <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h3>Avaliações</h3>
        </div>

        <div class="grid-container detalhes-comentarios-avaliacao margem">
            <div class="detalhes-comentarios">
                <h3>Comentários</h3>

                @if(count($avaliacao) > 0)

                    @foreach ($avaliacao as $avaliacao)
                        <div class="grid-container detalhes-foto-nome">
                            <div>

                                @if($avaliacao->gostou)
                                    <i class="fa-solid fa-thumbs-up"></i>
                                @else
                                    <i class="fa-solid fa-thumbs-down"></i>
                                @endif

                            </div>
                            <div>
                                <h4>{{$avaliacao->nome}} {{$avaliacao->sobrenome}}</h4>
                                <p>{{$avaliacao->texto_avaliacao}}</p>
                            </div>
                        </div>
                    @endforeach

                    {{-- @for ($i = 0; $i < count($avaliacao); $i++)
                        <div class="grid-container detalhes-foto-nome">
                            <div>

                                @if($avaliacao[$i]->gostou)
                                    <i class="fa-solid fa-thumbs-up"></i>
                                @else
                                    <i class="fa-solid fa-thumbs-down"></i>
                                @endif

                            </div>
                            <div>
                                <h4>{{$teste[$i][0]}}</h4>
                                <p>{{$avaliacao[$i]->texto_avaliacao}}</p>
                            </div>
                        </div>
                    @endfor


                @else
                    <h4>Ainda não há avaliações para o produto</h4>
                @endif

            </div>

            @if(Auth::check())
                <div class="detalhes-avaliacao">
                    <h3>Gostou do produto?</h3>
                    <form action="/avaliacoes/create" method="post">
                    @csrf

                        {{-- manda os ids de cliente e produto
                        <input type="hidden" name="id_usuario" value="{{Auth::user()->id}}">
                        <input type="hidden" name="id_produto" value="{{$produto->id}}">

                        <input type="radio" name="gostou" value="1" >Adorei!<br>
                        <input type="radio" name="gostou" value="0" >Odiei!<br>
                        <label for="texto">Deixe sua avaliação: (máx. 100 caracteres)</label>
                        <textarea name="texto_avaliacao" id="texto" cols="80" rows="10"></textarea>
                        <button class="bt-red">Enviar</button>

                    </form>
                </div>
            @endif

        </div>--}}

    </section>
@endsection
