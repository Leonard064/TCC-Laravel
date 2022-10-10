@extends('layouts.main')

@section('title', 'OC Hardware - Produtos')

@section('conteudo')
    <section class="grid-container corpo-produtos margem">
        <div class="lateral">
            <div class="flex-container nav-lateral">
                <h2>Busca Específica</h2>
                <form action="" method="post">
                    <h3>Seção</h3>
                    <input type="checkbox" name="" id="processador"><label for="processador">Processador</label><br>
                    <input type="checkbox" name="" id="placa-mae"><label for="placa-mae">Placa-Mãe</label><br>
                    <input type="checkbox" name="" id="placa-de-video"><label for="placa-de-video">Placa de Vídeo</label><br>
                    <input type="checkbox" name="" id="memoria"><label for="memoria">Memória</label><br>
                    <input type="checkbox" name="" id="monitor"><label for="monitor">Monitor</label><br>
                    <input type="checkbox" name="" id="mouse-teclado"><label for="mouse-teclado">Mouse e Teclado</label><br>
                    <input type="checkbox" name="" id="hd-ssd"><label for="hd-ssd">HD e SSD</label><br>
                    <input type="checkbox" name="" id="fonte"><label for="fonte">Fonte</label><br>

                    <h3>Marcas</h3>
                    <input type="checkbox" name="" id="amd"><label for="amd">AMD</label><br>
                    <input type="checkbox" name="" id="intel"><label for="intel">Intel</label><br>
                    <input type="checkbox" name="" id="nvidia"><label for="nvidia">Nvidia</label><br>
                    <input type="checkbox" name="" id="asus"><label for="asus">Asus</label><br>
                    <input type="checkbox" name="" id="palit"><label for="palit">Palit</label><br>
                    <input type="checkbox" name="" id="powercolor"><label for="powercolor">Powercolor</label><br>
                    <input type="checkbox" name="" id="gigabyte"><label for="gigabyte">Gigabyte</label><br>
                    <input type="checkbox" name="" id="super-frame"><label for="super-frame">Super Frame</label><br>
                    <input type="checkbox" name="" id="kingston"><label for="kingston">Kingston</label><br>

                    <h3>Sub-marcas</h3>

                    <input type="checkbox" name="" id="aorus"><label for="aorus">AORUS</label><br>
                    <input type="checkbox" name="" id="rog"><label for="rog">ROG</label><br>
                    <input type="checkbox" name="" id="hyperx"><label for="hyperx">HyperX</label><br>

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
                    @foreach ($produto as $itens)
                        <div class="card">
                            <div class="flex-container card-img">
                                <a href="/detalhes/{{$itens->id}}">
                                    <img src="../img/produtos/{{$itens->foto}}" alt="Overclock-teste">
                                </a>
                            </div>
                            <div class="preco">
                                <h3>{{$itens->nome}}</h3>
                                <span>{{$itens->nome}}</span>
                            </div>
                            <div class="comprar">
                                <span>R${{$itens->preco}}</span>
                                <button class="bt-red">Comprar</button>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section>
@endsection
