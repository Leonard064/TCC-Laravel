@extends('layouts.main')

@section('title', 'Carrinho - OCHardware')

@section('conteudo')
    <div class="flex-container corpo margin-new">

        <div class="flex-container topo-secao bg-gray border-10 secao-carrinho-checkout no-border-sm">
            <i class="fa-solid fa-square red"></i>
            <h2>Checkout</h2>
        </div>

        <div class="grid-container carrinho checkout">
            <div class="grid-container carrinho-lista checkout-lista bg-gray border-10 padding-detalhes no-border-sm">

                <h2>Itens</h2>

                <table class="tabela-geral">
                    <tr class="border-white">
                        <th class="padding-tabela-vh">Foto</th>
                        <th class="padding-tabela-vh">Nome</th>
                        <th class="padding-tabela-vh">Quantidade</th>
                        <th class="padding-tabela-vh">Valor</th>
                    </tr>

                        @php
                            $total = 0;
                            $peso  = 0;
                            $totalquadr = 0;
                            $raiz = 0;
                        @endphp

                        @foreach ($prod_carrinho as $itens)
                            <tr class="border-white">

                                <td class="padding-tabela-vh">
                                    <img src="../img/produtos/{{$itens->foto}}" class="carrinho-img border-10">
                                </td>

                                {{-- <td>{{$itens->foto}}</td> depois chamar a imagem real --}}

                                <td class="padding-tabela-vh">{{$itens->nome}}</td>

                                <td class="padding-tabela-vh">{{$itens->quantidade}}</td>

                                <td class="padding-tabela-vh">R${{number_format($itens->preco,2,',','.')}}</td>

                            </tr>

                            @php
                                //faz uma raiz cubica para o calculo de tamanho de caixa
                                $totalquadr += ($itens->altura * $itens->largura * $itens->comprimento) * $itens->quantidade;

                                $raiz = round(pow($totalquadr, 1/3),2);

                                $total += $itens->preco * $itens->quantidade;
                                $peso  += $itens->peso * $itens->quantidade;
                            @endphp

                        @endforeach


                </table>

            </div>

            <div class="grid-container frete bg-gray border-10 padding-detalhes no-border-sm">


                <h2>Endereço de Entrega</h2>

                {{-- <h2>Endereço de Entrega</h2> --}}

                    @if(count($enderecos) > 0)

                        <form action="/pedido/create" class="formFrete" method="post">
                            @csrf

                            <h3>Selecione um Endereço:</h3>

                            @foreach ($enderecos as $endereco)

                                <input type="radio" name="id_endereco" id="{{$endereco->id}}" value="{{$endereco->id}}" onclick="ajax({{$endereco->id}}, {{$peso}}, {{$total}}, {{$raiz}})" required>
                                <label for="{{$endereco->id}}">{{$endereco->endereco}}</label><br>

                            @endforeach

                            <h2>Frete e Prazos</h2>

                            {{-- <h2>Frete e Prazos</h2> --}}

                                <div id="frete">
                                    <p>Selecione um endereço</p>
                                </div>

                    @else

                        <h3>Você ainda não possui endereço cadastrado. Insira um agora</h3>
                        <a href="/adicionar-endereco">Adicionar um endereço</a>

                    @endif

            </div>

            <div class="grid-container carrinho-total checkout-total bg-gray border-10 padding-detalhes no-border-sm">

                <h2>Pagamento</h2>

                <div class="checkout-pagamento">
                    <div class="form-opcoes checkout-op">
                        <input type="radio" name="pagamento_tipo" value="boleto" required>Boleto
                    </div>
                    <div class="form-opcoes checkout-op">
                        <input type="radio" name="pagamento_tipo" value="pag_seguro">PagSeguro
                    </div>
                    <div class="form-opcoes checkout-op">
                        <input type="radio" name="pagamento_tipo" value="pix">Pix
                    </div>
                </div>

                <div class="flex-container carrinho-preco bg-teste border-10 total-bottom">
                    <h2>Total</h2>
                    <h2 class="label-preco red">R${{number_format($total,2,',','.')}}</h2>

                    <button class="bt-red">Finalizar Compra</button>

                </div>

                </form>{{-- fim do form PEDIDO-CREATE --}}
            </div>

        </div>

    </div>

@endsection
