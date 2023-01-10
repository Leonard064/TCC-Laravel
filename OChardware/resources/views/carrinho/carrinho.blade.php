@extends('layouts.main')

@section('title', 'Carrinho - OCHardware')

@section('conteudo')
    <div class="flex-container corpo margem">
        <h2>Página Carrinho</h2>

            @if(count($prod_carrinho) > 0)
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
                                <td>
                                    <a href="/removerQtd/{{$itens->id}}"><i class="fa-solid fa-minus"></i></a>
                                        {{$itens->quantidade}}
                                    <a href="/addQtd/{{$itens->id}}"><i class="fa-solid fa-plus"></i></a>
                                </td>
                                <td>R${{number_format($itens->preco, 2,',','.')}}</td>
                                <td><a href="/removerCarrinho/{{$itens->id}}"><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>

                            @php
                                $total += $itens->preco * $itens->quantidade;
                            @endphp

                        @endforeach

                        {{-- A repetição vai em cima de prod_carrinho (já que ambos terão a mesma contagem)
                        @for ($i = 0; $i < count($prod_carrinho); $i++)
                            <tr>
                                <td>{{$carrinho[$i][0]['foto']}}</td> {{-- depois chamar a imagem real--}}

                                {{-- Carrinho tem uma contagem "peculiar" pois são dois arrays, e o interno sempre terá somente 1 posição (0) --}}

                               {{-- <td>{{$carrinho[$i][0]['nome']}}</td>
                                <td>
                                    <a href="/removerQtd/{{$prod_carrinho[$i]->id}}"><i class="fa-solid fa-minus"></i></a>
                                        {{$prod_carrinho[$i]->quantidade}}
                                    <a href="/addQtd/{{$prod_carrinho[$i]->id}}"><i class="fa-solid fa-plus"></i></a>
                                </td>
                                <td>R${{number_format($carrinho[$i][0]['preco'],2,',','.')}}</td>
                                <td><a href="/removerCarrinho/{{$prod_carrinho[$i]->id}}"><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>

                            @php
                                $total += $carrinho[$i][0]['preco'] * $prod_carrinho[$i]->quantidade;
                            @endphp

                        @endfor --}}

                </table>

                    {{-- <form action="" class="formFrete"> -- To Do
                        @csrf
                        <label for="cep">Insira o seu CEP</label>
                        <input type="text" class="cep" name="cep" id="cep">
                        <button class="bt-red">Enviar</button>
                    </form> --}}

                    <form action="/checkout" method="post">
                    @csrf
                        {{-- <h2>Frete e Prazos</h2>

                            @php
                                $sedex = 27.00;
                                $pac = 14.90;
                            @endphp

                            <input type="radio" name="frete" id="sedex" value="sedex">
                            <label for="sedex">Sedex - {{number_format($sedex,2,',','.')}} (4 dias)</label>
                            <input type="radio" name="frete" id="pac" value="pac">
                            <label for="pac">PAC - {{number_format($pac,2,',','.')}} (7 dias)</label> --}}


                            <h2>Total</h2>

                                <h3>R${{number_format($total,2,',','.')}}</h3>

                                <input type="hidden" name="total" value="{{$total}}">


                            <button class="bt-red">Finalizar Compra</button>

                    </form>

            @else
                <i class="fa-solid fa-cart-arrow-down fa-2xl"></i>
                <h2>Seu carrinho está vazio!</h2>
                <a href="/">Vá as compras</a>
            @endif


    </div>

@endsection
@push('scripts')
    <script>
        let formFrete = document.querySelector('form.formFrete')

            formFrete.addEventListener('submit', e => {
                e.preventDefault()
                let url = '/api/frete';
                let cep = document.querySelector('input.cep').value;

                let body = {
                    'cep': cep
                };

                fetch(url,{
                    'method': 'POST',
                    'headers':{'Content-Type':'application/json'},
                    'params': JSON.stringify(body)
                }) //ajax
                    .then(response => response.json())
                    .then(responseBody => {
                        let formParent = formFrete.parentElement

                        let div = document.createElement('div')
                        div.className = 'frete'
                        div.innerText = JSON.stringify(responseBody.data)

                        formParent.appendChild(div);
                    })
            })

            function mudaQtd(){
                let valor = document.getElementById('quantidade').value
                let id = document.getElementById('id').value
                alert("valor: "+valor+"\n id: "+id)
            }

    </script>
@endpush

