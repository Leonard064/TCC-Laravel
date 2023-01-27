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

                    @php
                        $total = 0;
                    @endphp

                    @foreach ($prod_carrinho as $itens)
                        <tr>
                            <td>{{$itens->foto}}</td> {{-- depois chamar a imagem real--}}

                            <td>{{$itens->nome}}</td>

                            <td>{{$itens->quantidade}}</td>

                            <td>R${{number_format($itens->preco,2,',','.')}}</td>

                        </tr>

                        @php
                            $total += $itens->preco * $itens->quantidade;
                        @endphp

                    @endforeach


            </table>

            <h2>Endereço de Entrega</h2>


                {{-- Método de criação de pedido --}}
                @if (count($enderecos) > 0)

                    <form action="/pedido/create" class="formFrete" method="post">
                        @csrf

                        <h3>Selecione um Endereço:</h3>

                        @foreach ($enderecos as $endereco)

                            <input type="radio" name="endereco" id="{{$endereco->id}}" value="{{$endereco->id}}" onclick="ajax({{$endereco->id}})">
                            <label for="{{$endereco->id}}">{{$endereco->endereco}}</label><br>

                        @endforeach

                        {{-- <input type="hidden" name="total_pedido" value="{{$total}}">
                        <input type="hidden" name="frete_tipo" value="{{$frete}}">
                        <input type="hidden" name="frete_valor" value="{{$valor_frete}}"> --}}

                        <h2>Frete e Prazos</h2>

                            <div class="grid-container" id="teste">
                                <p>Selecione um endereço</p>
                            </div>

                            @php
                                $sedex = 27.00;
                                $pac = 14.90;
                            @endphp

                            {{-- <input type="radio" name="frete" id="sedex" value="sedex">
                            <label for="sedex">Sedex - {{number_format($sedex,2,',','.')}} (4 dias)</label><br>
                            <input type="radio" name="frete" id="pac" value="pac">
                            <label for="pac">PAC - {{number_format($pac,2,',','.')}} (7 dias)</label> --}}


                @else

                    <form action="/endereco/create-via-checkout" method="post">
                        @csrf

                            <h3>Você ainda não possui endereço cadastrado. Insira um agora</h3>

                            <input type="text" name="cep" id="cep" placeholder="cep"><br>
                            <input type="text" name="endereco" id="endereco" placeholder="endereco"><br>
                            <input type="text" name="numero" id="numero" placeholder="numero"><br>
                            <input type="text" name="estado" id="estado" placeholder="estado"><br>
                            <input type="text" name="municipio" id="municipio" placeholder="municipio"><br>

                            <button class="bt-red">Cadastrar</button>

                                {{-- <input type="hidden" name="total_pedido" value="{{$total}}">
                                <input type="hidden" name="frete_tipo" value="{{$frete}}">
                                <input type="hidden" name="frete_valor" value="{{$valor_frete}}"> --}}

                            <h2>Frete e Prazos</h2>
                            <p>Cadastre um endereço para poder selecionar um frete.</p>

                    </form>

                @endif


                        <h2>Pagamento</h2>
                        <input type="radio" name="pagamento_tipo" value="boleto">Boleto
                        <input type="radio" name="pagamento_tipo" value="pag_seguro">PagSeguro


                        <h2>Total</h2>
                        <p>R${{number_format($total,2,',','.')}}</p>

                        <input type="hidden" name="total_pedido" value="{{$total}}">

                        <button class="bt-red">Finalizar Compra</button>

                    </form>

    </div>

@endsection
@push('scripts')
    <script>

        function ajax(id){

                // let corpo = document.querySelector('div.corpo');

                let url = '/api/frete/'+id;
                // let idCep = id;

                fetch(url,{
                    'method': 'POST',
                    'headers':{'Content-Type':'application/json'},
                    //'params': JSON.stringify(idCep)
                }) //ajax
                    .then(response => response.json())
                    .then(responseBody => {

                        // div por enquanto é criada abaixo do corpo, logo não aparece

                         let div = document.createElement('div')
                         div.id = 'frete'
                        // div.innerText = JSON.stringify(responseBody.data)

                        /*
                         * Cria os campos radio com as opções
                         * de fretes disponíveis
                         *
                        */
                        let tipoP =  JSON.stringify(responseBody.tipoPac)
                        let valorP = JSON.stringify(responseBody.valorPac)
                        let diasP =  JSON.stringify(responseBody.prazoPac)

                        let tipoS = JSON.stringify(responseBody.tipoSedex)
                        let valorS = JSON.stringify(responseBody.valorSedex)
                        let diasS = JSON.stringify(responseBody.prazoSedex)

                        //campos radio
                        let radio1 = document.createElement('input')
                        radio1.type = 'radio'
                        radio1.name = 'frete_tipo'
                        radio1.id = responseBody.tipoPac
                        radio1.value = responseBody.tipoPac

                        var label1 = document.createElement('label')
                        label1.htmlFor = 'pac'

                        var nvLinha1 = document.createElement('br')

                        var descricao1 = document.createTextNode( tipoP +' - R$'+ valorP +' - '+ diasP + ' Dias.');
                        label1.appendChild(descricao1)

                        // -------

                        let radio2 = document.createElement('input')
                        radio2.type = 'radio'
                        radio2.name = 'frete_tipo'
                        radio2.id = responseBody.tipoSedex
                        radio2.value = responseBody.tipoSedex

                        var label2 = document.createElement('label')
                        label2.htmlFor = 'sedex'

                        var nvLinha2 = document.createElement('br')

                        var descricao2 = document.createTextNode( tipoS +' - R$'+ valorS +' - '+ diasS + ' Dias.');
                        label2.appendChild(descricao2)



                        //campo hidden - para passagem de valor do frete
                        // let hidd = document.createElement('input')
                        // hidd.type = 'hidden'
                        // hidd.name = 'frete_valor'
                        // hidd.value = valor

                        //chama os inputs na DOM
                        document.getElementById('teste').appendChild(div)
                        document.getElementById('frete').appendChild(radio1)
                        document.getElementById('frete').appendChild(label1)
                        document.getElementById('frete').appendChild(nvLinha1)

                        document.getElementById('frete').appendChild(radio2)
                        document.getElementById('frete').appendChild(label2)
                        document.getElementById('frete').appendChild(nvLinha2)

                        // document.getElementById('frete').appendChild(hidd)

                        // alert(JSON.stringify(responseBody.data));
                        // let formParent = frete.parentElement

                        // let div = document.createElement('div')
                        // div.className = 'frete'
                        // div.innerText = JSON.stringify(responseBody.data)

                        // formParent.appendChild(div);
                    })

        }

    </script>
@endpush
