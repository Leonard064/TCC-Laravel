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

                        {{-- A repetição vai em cima de prod_carrinho (já que ambos terão a mesma contagem) --}}
                        @for ($i = 0; $i < count($prod_carrinho); $i++)
                            <tr>
                                <td>{{$carrinho[$i][0]['foto']}}</td> {{-- depois chamar a imagem real--}}

                                {{-- Carrinho tem uma contagem "peculiar" pois são dois arrays, e o interno sempre terá somente 1 posição (0) --}}

                                <td>{{$carrinho[$i][0]['nome']}}</td>
                                <td>{{$prod_carrinho[$i]->quantidade}}</td>
                                <td>R${{$carrinho[$i][0]['preco']}}</td>
                                <td><a href="/removerCarrinho/{{$prod_carrinho[$i]->id}}"><i class="fa-solid fa-trash-can"></i></a></td>
                            </tr>

                            @php
                                $total = 0;
                                $total = $carrinho[$i][0]['preco'] * $prod_carrinho[$i]->quantidade;
                            @endphp

                        @endfor

                        {{-- @foreach ($carrinho as $itens)

                                <tr>
                                    <td>img.png</td>
                                    <td>{{$itens[0]['nome']}}</td>
                                    <td>{{$itens_qtd->quantidade}}</td>
                                    <td>R${{$itens[0]['preco']}}</td>
                                    <td><a href="/removerCarrinho/{{$itens[0]['id']}}">excluir</a></td>
                                </tr>

                        @endforeach --}}

                </table>

                    <h2>Frete e Prazos</h2>
                    <form action="" class="formFrete">
                        <label for="cep">Insira o seu CEP</label>
                        <input type="text" class="zipcode" name="cep" id="cep">
                        <button class="bt-red">Enviar</button>
                    </form>

                    <h2>Total</h2>
                        <h3>R$
                            @php
                                echo number_format($total,2,',','.');
                            @endphp
                        </h3>

                    <button class="bt-red">Finalizar Compra</button>

            @else
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
                let url = '/api/frete'

                fetch(url) //ajax
                    .then(response => response.json())
                    .then(responseBody => alert('Valor : R$'+responseBody.valor+'\n'+responseBody.dias+' Dias.'))
            })
    </script>
@endpush

