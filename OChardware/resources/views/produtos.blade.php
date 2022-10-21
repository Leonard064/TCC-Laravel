@extends('layouts.main')

@section('title', 'OC Hardware - Produtos')

@section('conteudo')
    <section class="grid-container corpo-produtos margem">
        <div class="lateral">
            <div class="flex-container nav-lateral">
                <h2>Busca Específica</h2>
                <form action="" method="post">

                    <h3>Marcas</h3>
                    @for ($i = 0; $i < 9; $i++)
                        <input type="radio" name="marca" id="marca"><label for="marca">Marca {{$i}}</label><br>
                    @endfor

                    <h3>Seção</h3>
                    <input type="radio" name="processador" id="processador"><label for="processador">Processador</label><br>
                    <input type="radio" name="placa-mae" id="placa-mae"><label for="placa-mae">Placas-Mãe</label><br>
                    <input type="radio" name="placa-de-video" id="placa-de-video"><label for="placa-de-video">Placas de Vídeo</label><br>
                    <input type="radio" name="" id="memoria"><label for="memoria">Memória</label><br>
                    <input type="radio" name="" id="monitor"><label for="monitor">Monitor</label><br>
                    <input type="radio" name="" id="mouse-teclado"><label for="mouse-teclado">Mouse e Teclado</label><br>
                    <input type="radio" name="" id="hd-ssd"><label for="hd-ssd">HD e SSD</label><br>
                    <input type="radio" name="" id="fonte"><label for="fonte">Fonte</label><br>

                    <h3>Preço</h3>

                    <input type="checkbox" name="" id="baixo"><label for="baixo">R$0,00 até R$100,00</label><br>
                    <input type="checkbox" name="" id="medio"><label for="medio">R$100,00 até R$500,00</label><br>
                    <input type="checkbox" name="" id="alto"><label for="alto">R$500,00 até R$1000,00</label><br>
                    <input type="checkbox" name="" id="caro"><label for="caro">Acima de R$1000,00</label><br><br>

                    <button class="bt-red">Pesquisar</button>

                </form>
            </div>

        </div>
        <div class="flex-container produtos">

            @if($pesquisa)
                <h2>Resultados para "{{$pesquisa}}"</h2>
            @elseif($categoria)
                <h2>Resultados para "{{$categoria}}"</h2>
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
