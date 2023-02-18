@extends('layouts.main')

@section('title', 'OC Hardware - Produtos')

@section('conteudo')
    <section class="grid-container corpo-produtos margem">
        <div class="lateral">
            <div class="flex-container nav-lateral">
                <h2>Busca Específica</h2>
                <form action="/pesquisa-produtos" method="POST">
                    @csrf

                    <h3>Marcas</h3>

                        @if($marca)

                            @foreach ($marca as $marcas)
                                <input type="radio" name="marca" id="{{$marcas->nome}}" value="{{$marcas->id}}">
                                <label for="{{$marcas->nome}}">{{$marcas->nome}}</label><br>
                            @endforeach

                        @else

                            <h4>Não há marcas</h4>
                        @endif

                    <h3>Seção</h3>
                        @if (count($categoriaBE)<=0)
                            <h4>Não há categorias</h4>
                        @else
                            @foreach ($categoriaBE as $categorias)
                                <input type="radio" name="categoria" id="{{$categorias->nome}}" value="{{$categorias->id}}">
                                <label for="{{$categorias->nome}}">{{$categorias->nome}}</label><br>
                            @endforeach
                        @endif

                    <h3>Preço</h3>

                    <label for="valorMin">De:</label><br>
                    <input type="number" name="valorMin" id="valorMin" min="1"><br>

                    <label for="valorMax">Até:</label><br>
                    <input type="number" name="valorMax" id="valorMax" min="1">

                    {{-- <input type="radio" name="valor" value="baixo"><label for="baixo">R$0,00 até R$100,00</label><br>
                    <input type="radio" name="valor" value="medio"><label for="medio">R$100,00 até R$500,00</label><br>
                    <input type="radio" name="valor" value="alto"><label for="alto">R$500,00 até R$1000,00</label><br>
                    <input type="radio" name="valor" value="caro"><label for="caro">Acima de R$1000,00</label><br><br> --}}

                    <button class="bt-red">Filtrar</button>

                </form>
            </div>

        </div>
        <div class="flex-container produtos">

            @if($pesquisa)
                <h2>Resultados para "{{$pesquisa}}"</h2>
            @elseif($categoria)
                <h2>Resultados para "{{$categoria[0]->nome}}"</h2>
            @endif

            <div class="flex-container itens">

                @if(count($produto) === 0 && $pesquisa)

                    <h1>A pesquisa não encontrou resultados.</h1>

                @elseif(count($produto) === 0)

                    <h1>Não há produtos.</h1>

                @else

                    @include('layouts._produtos')

                @endif


            </div>
        </div>
    </section>
@endsection
