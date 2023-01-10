@extends('layouts.main')

@section('title', 'Carrinho - OCHardware')

@section('conteudo')
    <div class="flex-container corpo margem">
        <h1>Checkout</h1>

        <h2>Produtos</h2>
            <table>
                <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>

                    @foreach ($prod_carrinho as $itens)
                        <tr>
                            <td>{{$itens->foto}}</td> {{-- depois chamar a imagem real--}}

                            <td>{{$itens->nome}}</td>

                            <td>{{$itens->quantidade}}</td>

                            <td>R${{number_format($itens->preco,2,',','.')}}</td>

                        </tr>
                    @endforeach


            </table>

            <h2>Endereço de Entrega</h2>


                {{-- Método de criação de pedido com endereço já existente --}}
                @if (count($enderecos) > 0)

                    <form action="/pedido/create-with-endereco" method="post">
                        @csrf

                        <h3>Selecione um Endereço:</h3>

                        @foreach ($enderecos as $endereco)

                            <input type="radio" name="endereco" id="{{$endereco->id}}" value="{{$endereco->id}}">
                            <label for="{{$endereco->id}}">{{$endereco->endereco}}</label><br>

                        @endforeach

                        {{-- <input type="hidden" name="total_pedido" value="{{$total}}">
                        <input type="hidden" name="frete_tipo" value="{{$frete}}">
                        <input type="hidden" name="frete_valor" value="{{$valor_frete}}"> --}}

                        <h2>Frete e Prazos</h2>

                            @php
                                $sedex = 27.00;
                                $pac = 14.90;
                            @endphp

                            <input type="radio" name="frete" id="sedex" value="sedex">
                            <label for="sedex">Sedex - {{number_format($sedex,2,',','.')}} (4 dias)</label><br>
                            <input type="radio" name="frete" id="pac" value="pac">
                            <label for="pac">PAC - {{number_format($pac,2,',','.')}} (7 dias)</label>


                        <h2>Pagamento</h2>
                        <input type="radio" name="pagamento_tipo" value="boleto">Boleto
                        <input type="radio" name="pagamento_tipo" value="pag_seguro">PagSeguro

                        {{-- <h2>Frete escolhido</h2>
                        <p>{{$frete}}</p> --}}


                        <h2>Total</h2>
                        <p>R${{number_format($total,2,',','.')}}</p>

                        <button class="bt-red">Finalizar Compra</button>

                    </form>

                @else

                    {{-- criação de pedido com cadastro de endereço --}}
                    <form action="/endereco/create-via-checkout" method="post">
                        @csrf

                        <h3>Você ainda não possui endereço cadastrado. Insira um agora</h3>

                        <input type="text" name="cep" id="cep" placeholder="cep">
                        <input type="text" name="endereco" id="endereco" placeholder="endereco">
                        <input type="text" name="numero" id="numero" placeholder="numero">
                        <input type="text" name="estado" id="estado" placeholder="estado">
                        <input type="text" name="municipio" id="municipio" placeholder="municipio">

                        {{-- <input type="hidden" name="total_pedido" value="{{$total}}">
                        <input type="hidden" name="frete_tipo" value="{{$frete}}">
                        <input type="hidden" name="frete_valor" value="{{$valor_frete}}"> --}}


                        <h2>Frete e Prazos</h2>
                        <p>Adicione um endereço para selecionar o frete.</p>

                        <h2>Pagamento</h2>

                        <input type="radio" name="pagamento_tipo" value="boleto">Boleto <br>
                        <input type="radio" name="pagamento_tipo" value="pag_seguro">PagSeguro

                        {{-- <h2>Frete escolhido</h2>
                        <p>{{$frete}}</p> --}}

                        <h2>Total</h2>
                        <p>R${{number_format($total,2,',','.')}}</p>



                        <button class="bt-red">Finalizar Compra</button>

                    </form>

                @endif


    </div>

@endsection
