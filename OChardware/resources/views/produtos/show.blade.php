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
                <h4>comentários</h4>
            </div>
            <div class="detalhes-avaliacao">
                <h4>Gostou do produto? deixe sua avaliação</h4>
                <form action="">
                    <input type="text" name="" id="" class="input-full" placeholder="Nome"><br>
                    <input type="text" name="" id="" class="input-full" placeholder="Email"><br>
                    <label for="texto">Escreva aqui: (máx. 150 caracteres)</label>
                    <textarea name="" id="texto" cols="80" rows="10"></textarea>
                </form>
            </div>
        </div>

    </section>
@endsection
