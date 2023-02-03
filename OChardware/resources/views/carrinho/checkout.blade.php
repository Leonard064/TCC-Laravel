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
                        $peso  = 0;
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
                            $peso  += $itens->peso * $itens->quantidade;
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

                            <input type="radio" name="endereco" id="{{$endereco->id}}" value="{{$endereco->id}}" onclick="ajax({{$endereco->id}}, {{$peso}})">
                            <label for="{{$endereco->id}}">{{$endereco->endereco}}</label><br>

                        @endforeach

                        {{-- <input type="hidden" name="total_pedido" value="{{$total}}">
                        <input type="hidden" name="frete_tipo" value="{{$frete}}">
                        <input type="hidden" name="frete_valor" value="{{$valor_frete}}"> --}}

                        <h2>Frete e Prazos</h2>

                            <div id="frete">
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

                        <h2>Peso</h2>
                        <p>{{number_format($peso,2,',','.')}}Kg</p>

                        <input type="hidden" name="total_pedido" value="{{$total}}">

                        <button class="bt-red">Finalizar Compra</button>

                    </form>

    </div>

@endsection
@push('scripts')
    <script>

        var totalPAC;
        var totalSEDEX;

        var selecionaPac = function(){

            let hidd = document.createElement('input')
            hidd.type = 'hidden'
            hidd.name = 'frete_valor'
            hidd.value = totalPAC

            document.getElementById('frete').appendChild(hidd)

            alert("Input Criado!\n totalPAC: "+ totalPAC)
        }

        var selecionaSedex = function(){

            let hidd = document.createElement('input')
            hidd.type = 'hidden'
            hidd.name = 'frete_valor'
            hidd.value = totalSEDEX

            document.getElementById('frete').appendChild(hidd)

            alert("Input Criado\n totalSEDEX: "+ totalSEDEX)
    }


        function ajax(id,peso){

                document.getElementById('frete').innerHTML = "Carregando...";

                // let corpo = document.querySelector('div.corpo');

                let url = '/api/frete/'+id+'/'+peso;
                // let idCep = id;

                fetch(url,{
                    'method': 'POST',
                    'headers':{'Content-Type':'application/json'},
                    //'params': JSON.stringify(idCep)
                }) //ajax
                    .then(response => response.json())
                    .then(responseBody => {

                        // div por enquanto é criada abaixo do corpo, logo não aparece

                         let div = document.getElementById('frete')

                         div.innerHTML = "";
                        //  div.id = 'frete'
                        // div.innerText = JSON.stringify(responseBody.data)

                        /*
                         * Pega os valores retornados
                         * e os salva em variaveis separadas
                         *
                        */
                        let tipoP =  responseBody.tipoPac
                        let valorP = responseBody.valorPac
                        let diasP =  responseBody.prazoPac

                        let tipoS = responseBody.tipoSedex
                        let valorS = responseBody.valorSedex
                        let diasS = responseBody.prazoSedex

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

                        //salva o valor de cada serviço em uma variavel global
                        totalPAC = valorP
                        totalSEDEX = valorS

                        //chama os inputs na DOM
                        // document.getElementById('frete').appendChild(div)
                        div.appendChild(radio1)
                        div.appendChild(label1)
                        div.appendChild(nvLinha1)

                        div.appendChild(radio2)
                        div.appendChild(label2)
                        div.appendChild(nvLinha2)

                        //cria o listener para click nos radio buttons
                        radio1.addEventListener('click', selecionaPac)
                        radio2.addEventListener('click', selecionaSedex)

                    })

        }

    </script>
@endpush
