@extends('layouts.main')

@section('title','OC - Admin')

@section('conteudo')
    <div class="flex-container corpo-detalhes">
        <div class="detalhes-topo bg-gray border-10 margin-new padding-detalhes">
            <h1>Painel Administrador</h1>
            {{-- <a href="/create-categoria">Criar Categoria</a>&nbsp; --}}
            <a href="/create-marca">Criar Marca</a>&nbsp;
            <a href="/create-produto">Criar Produto</a>

        </div>

        <div class="grid-container dash-pedido-produto margin-new">
            <div class="ult-pedidos bg-gray border-10 padding-detalhes">
                <div class="flex-container topo-secao">
                    <i class="fa-solid fa-square red"></i>
                    <h3>Pedidos Abertos</h3>
                </div>

                @if (count($pedidos) > 0)

                @foreach ($pedidos as $pedido)
                    <table>
                        <caption>Pedido: {{$pedido->id}}</caption>
                        <tr>
                            <th>Data e hora</th>
                            <th>Pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>{{$pedido->created_at}}</td>
                            <td>{{$pedido->pagamento_tipo}}</td>
                            <td>{{$pedido->total_pedido}}</td>
                            <td>{{$pedido->status}}</td>
                            <td><a href="/editar-pedido/{{$pedido->id}}">Editar Status</a></td>
                        </tr>
                    </table>

                @endforeach

                <a href="/todos-pedidos">
                    <button class="bt-red">Visualizar todos os Pedidos</button>
                </a>

            @else
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2>Ainda não foram realizados Pedidos</h2>
            @endif

            </div>
            <div class= "todos-produtos bg-gray border-10 padding-detalhes">
                <div class="flex-container topo-secao">
                    <i class="fa-solid fa-square red"></i>
                    <h3>Produtos</h3>
                </div>

                @if (count($produtos) > 0)

                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Opções</th>
                    </tr>
                    @foreach ($produtos as $produto)

                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td><a href="/editar-produto/{{$produto->id}}">Editar</a></td>
                                <td><a href="/remover-produto/{{$produto->id}}">Excluir</a></td>
                            </tr>

                    @endforeach

                </table>

                <a href="/todos-produtos">
                    <button class="bt-red">Visualizar todos os Produtos</button>
                </a>

            @else
                <h2>Não há Produtos</h2>

            @endif

            </div>
        </div>

        {{-- versão 2 --}}
        {{-- <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h3>Últimos Pedidos Abertos</h3>
        </div>

        <div class="detalhes-descricao margem">
            @if (count($pedidos) > 0)

                @foreach ($pedidos as $pedido)
                    <table>
                        <caption>Pedido: {{$pedido->id}}</caption>
                        <tr>
                            <th>Data e hora</th>
                            <th>Pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                        <tr>
                            <td>{{$pedido->created_at}}</td>
                            <td>{{$pedido->pagamento_tipo}}</td>
                            <td>{{$pedido->total_pedido}}</td>
                            <td>{{$pedido->status}}</td>
                            <td><a href="/editar-pedido/{{$pedido->id}}">Editar Status</a></td>
                        </tr>
                    </table>

                @endforeach

                <a href="/todos-pedidos">
                    <button class="bt-red">Visualizar todos os Pedidos</button>
                </a>

            @else
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2>Ainda não foram realizados Pedidos</h2>
            @endif
        </div>

        <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h3>Produtos</h3>
        </div>

        <div class="detalhes-descricao margem">
            @if (count($produtos) > 0)

                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Opções</th>
                    </tr>
                    @foreach ($produtos as $produto)

                            <tr>
                                <td>{{$produto->nome}}</td>
                                <td><a href="/editar-produto/{{$produto->id}}">Editar</a></td>
                                <td><a href="/remover-produto/{{$produto->id}}">Excluir</a></td>
                            </tr>

                    @endforeach

                </table>

                <a href="/todos-produtos">
                    <button class="bt-red">Visualizar todos os Produtos</button>
                </a>

            @else
                <h2>Não há Produtos</h2>

            @endif

        </div> --}}
    </div>

@endsection
