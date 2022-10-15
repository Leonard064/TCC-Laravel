@extends('layouts.main')

@section('title','OC Hardware')

@section('conteudo')
    <section class="flex-container corpo">
        <div class="flex-container banner">
            <img src="img/logo2.png" alt="">
            <h1 class="heading banner-texto">Dê um OverClock!</h1>
        </div>
        <div class="flex-container secao">
            <h2>Nossos melhores produtos</h2>
        </div>

        {{-- Seção dos cards --}}

        <div class="flex-container itens margem">
            @if(count($produto)==0)
                <h1>Nenhum produto foi encontrado</h1>
            @else
                @include('layouts._produtos',['produto' => $produto])
            @endif
        </div>


        <div class="flex-container secao">
            <h2>Navegue pelas Seções</h2>
        </div>
        <div class="grid-container categorias">
            <button class="bt-red">
                Placas de Vídeo
                <img src="img/logo2.png" alt="" style="float: right;">
            </button>
            <button class="bt-red">
                Processadores
                <img src="img/logo2.png" alt="" style="float: right;">
            </button>
            <button class="bt-red">
                Placas-Mãe
                <img src="img/logo2.png" alt="" style="float: right;">
            </button>
            <button class="bt-red">
                Memórias
                <img src="img/logo2.png" alt="" style="float: left;">
            </button>
            <button class="bt-red">
                Monitores
                <img src="img/logo2.png" alt="" style="float: left;">
            </button>
            <button class="bt-red">
                Mouse e Teclado
                <img src="img/logo2.png" alt="" style="float: left;">
            </button>
            <button class="bt-red">
                HDs
                <img src="img/logo2.png" alt="" style="float: right;">
            </button>
            <button class="bt-red">
                SSDs
                <img src="img/logo2.png" alt="" style="float: right;">
            </button>
            <button class="bt-red">
                Fontes
                <img src="img/logo2.png" alt="" style="float: right;">
            </button>
        </div>
    </section>
@endsection
