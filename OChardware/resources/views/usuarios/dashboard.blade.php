@extends('layouts.main')

@section('title','OC - Admin')

@section('conteudo')
    <div class="flex-container corpo-detalhes">
        <div class="detalhes-topo bg-gray border-10 margin-new padding-detalhes">

            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h1>Painel Administrador</h1>
            </div>

            {{-- <h1>Painel Administrador</h1> --}}
            {{-- <a href="/create-categoria">Criar Categoria</a>&nbsp; --}}
            <div class="flex-container perfil-opcoes">
                <a class="no-deco font-black" href="/create-marca">Criar Marca</a>
                <a class="no-deco font-black" href="/create-produto">Criar Produto</a>
                <a class="no-deco font-black" href="/alterar-senha">Alterar Senha</a>
            </div>

        </div>

        <div class="grid-container dash-pedido-produto margin-new">
            <div class="ult-pedidos bg-gray border-10 padding-detalhes">
                <div class="flex-container topo-secao">
                    <i class="fa-solid fa-square red"></i>
                    <h3>Pedidos Abertos</h3>
                </div>

                <div class="dashboard-tabela-pedidos">
                    @if (count($pedidos) > 0)

                        <table class="tabela-geral">
                        {{-- <caption>Pedido: {{$pedido->id}}</caption> --}}
                            <tr class="black">
                                <th class="border-black padding-tabela-vh">Cod. Pedido</th>
                                <th class="border-black padding-tabela-vh">Data e hora</th>
                                <th class="border-black padding-tabela-vh">Pagamento</th>
                                <th class="border-black padding-tabela-vh">Valor</th>
                                <th class="border-black padding-tabela-vh">Status</th>
                                <th class="border-black padding-tabela-vh">Opções</th>
                            </tr>

                            @foreach ($pedidos as $pedido)
                                <tr class="bg-white">
                                    <td class="border-black padding-tabela-vh">{{$pedido->id}}</td>
                                    <td class="border-black padding-tabela-vh">{{$pedido->created_at}}</td>
                                    <td class="border-black padding-tabela-vh">{{$pedido->pagamento_tipo}}</td>
                                    <td class="border-black padding-tabela-vh">R$ {{number_format($pedido->total_pedido,2,',','.')}}</td>
                                    <td class="border-black padding-tabela-vh">{{$pedido->status}}</td>
                                    <td class="border-black padding-tabela-vh"><a href="/editar-pedido/{{$pedido->id}}">Editar Status</a></td>
                                </tr>


                            @endforeach

                        </table>

                        <a href="/todos-pedidos">
                            <button class="bt-red">Visualizar todos os Pedidos</button>
                        </a>

                    @else
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <h2>Ainda não foram realizados Pedidos</h2>
                    @endif

                </div>

            </div>
            <div class= "todos-produtos bg-gray border-10 padding-detalhes">
                <div class="flex-container topo-secao">
                    <i class="fa-solid fa-square red"></i>
                    <h3>Produtos</h3>
                </div>

                <div class="dashboard-tabela-produtos">
                    @if (count($produtos) > 0)

                        <table class="tabela-geral">
                            <tr class="black">
                                <th class="border-black padding-tabela-vh">Nome</th>
                                <th class="border-black padding-tabela-vh">Opções</th>
                            </tr>
                            @foreach ($produtos as $produto)

                                    <tr class="bg-white">
                                        <td class="border-black padding-tabela-vh">{{$produto->nome}}</td>
                                        <td class="border-black padding-tabela-vh"><a href="/editar-produto/{{$produto->id}}">Editar</a>
                                        <a href="/remover-produto/{{$produto->id}}">Excluir</a></td>
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
