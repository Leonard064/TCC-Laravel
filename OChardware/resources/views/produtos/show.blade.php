@extends('layouts.main')

@section('title','produto')

@section('conteudo')
    <section class="flex-container corpo-detalhes">
        <section class="detalhes-topo">
            <div class="grid-container detalhes-foto-nome margem">
                <div class="flex-container detalhes-foto">
                    <img src="../img/produtos/{{$produto->foto}}" alt="OverClock">
                </div>
                <div class="flex-container detalhes-nome">
                    @if($produto->quantidade <= 0)

                        <h2>{{$produto->nome}}</h2>
                        <h3>OPS! Não possuimos estoque desse produto.</h3>

                    @else

                        <h2>{{$produto->nome}}</h2>
                        <hr>
                        <h3>{{$produto->quantidade}} Peças disponíveis</h3>
                        <h3>R${{$produto->preco}}</h3>
                        <h4>Valor em pix/ à vista no cartão</h4>
                        <h4>10x de 99,90 sem juros</h4>
                        <form action="/addCarrinho" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$produto->id}}">
                            <button class="bt-red">Comprar</button>
                        </form>

                    @endif

                </div>
            </div>
        </section>

        <div class="flex-container secao">
            <h3>Descrição</h3>
        </div>
        <div class="detalhes-descricao margem">
            <p>{{$produto->descricao}}</p>
        </div>

        <div class="flex-container secao">
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
                    @endfor --}}


                @else
                    <h4>Ainda não há avaliações para o produto</h4>
                @endif

            </div>

            @if(Auth::check())
                <div class="detalhes-avaliacao">
                    <h3>Gostou do produto?</h3>
                    <form action="/avaliacoes/create" method="post">
                    @csrf

                        {{-- manda os ids de cliente e produto --}}
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

        </div>

    </section>
@endsection
