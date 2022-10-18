@extends('layouts.main')

@section('title', 'Carrinho - OCHardware')

@section('conteudo')
    <div class="flex-container corpo margem">
        <h1>Página Carrinho</h1>

            @if($carrinho)
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
                            <td><a href="/removerCarrinho/{{$prod_carrinho[$i]->id}}">excluir</a></td>
                        </tr>
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
            @else
                <h2>Seu carrinho está vazio!</h2>
                <a href="/">Vá as compras</a>
            @endif


    </div>

@endsection
