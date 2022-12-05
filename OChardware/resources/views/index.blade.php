@extends('layouts.main')

@section('title','OC Hardware')

@section('conteudo')
    <section class="flex-container corpo">
        <div class="flex-container banner">
            <img src="img/logo2.png" alt="">
            <h1 class="heading banner-texto">Dê um OverClock!</h1>
        </div>
        <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h2>Promoções do Momento</h2>
        </div>

        {{-- Seção dos cards --}}

        <div class="flex-container itens margem">
            @if(count($produto)==0)
                <h1>Nenhum produto foi encontrado</h1>
            @else
                @include('layouts._produtos',['produto' => $produto])
            @endif
        </div>


        <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i>&nbsp;
            <h2>Acabaram de Chegar</h2>
        </div>


        <div class="flex-container itens margem">
            @if(count($produto)==0)
                <h1>Nenhum produto foi encontrado</h1>
            @else
                @include('layouts._produtos',['produto' => $produto])
            @endif
        </div>
    </section>
@endsection
