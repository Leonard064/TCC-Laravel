@extends('layouts.main')

@section('title', 'Overclock® Hardware - Compra Efetuada!')

@section('conteudo')
    <section class="flex-container corpo-detalhes">
        <div class="pedido-concluido bg-gray border-10 margin-new padding-detalhes">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h2>Sucesso</h2>
            </div>
            <div class="flex-container" id="pedido-concluido-corpo">
                <h1>Compra Efetuada!</h1>
                <h3>Agradecemos por nos escolher</h3>

                <a href="/perfil">Checar meus pedidos</a>
                <a href="/">Comprar mais</a>
            </div>
        </div>
    </section>
@endsection
