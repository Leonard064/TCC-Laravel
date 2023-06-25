@extends('layouts.main')

@section('conteudo')
    <section class="flex-conteiner corpo-detalhes">
        <div class="pedido-concluido bg-gray border-10 margin-new padding-detalhes">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h2>Aviso</h2>
            </div>
            <div class="flex-container" id="pedido-concluido-corpo">
                <p><i class="fa-solid fa-regular fa-circle-exclamation ico-concluido red"></i></p>
                <h1 class="red aviso">Você está prestes a excluir um produto</h1>
                <h3 class="aviso">Isso significa que todas as avaliações pertinentes a eles
                    serão APAGADAS, assim como qualquer CARRINHO que o possua.
                </h3>
                <h3>Deseja prosseguir?</h3>

            </div>
            <div class="padding-detalhes">
                <a href="/remover-produto/{{$id_produto}}" class="center no-deco"><button class="bt-aviso">Sim</button></a>
                <a href="/dashboard" class="center no-deco"><button class="bt-aviso">Não</button></a>
            </div>
        </div>
    </section>
@endsection
