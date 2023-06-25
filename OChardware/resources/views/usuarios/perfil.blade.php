@extends('layouts.main')

@section('title', 'Meu Perfil - OCHardware')

@section('conteudo')
    <section class="flex-container corpo">
        <section class="detalhes-topo bg-gray border-10 margin-new no-border-sm">
            <div class="grid-container detalhes-foto-nome">
                <div class="flex-container perfil-foto">
                    <img src="img/usuarios/{{Auth::user()->foto}}" class="border-10" alt="Perfil">
                </div>
                <div class="flex-container detalhes-nome">
                    <h1>{{Auth::user()->nome}} {{Auth::user()->sobrenome}}</h1>
                    <div class="flex-container perfil-opcoes">
                        <a class="no-deco font-black" href="/editar-perfil">Editar Cadastro</a>
                        <a class="no-deco font-black" href="/alterar-senha">Alterar Senha</a>
                        <a class="no-deco font-black" href="/meus-pedidos">Meus Pedidos</a>
                        <a class="no-deco font-black" href="/adicionar-endereco">Meus Endereços</a>
                        {{-- <a class="no-deco font-black" href="/adicionar-endereco">Adicionar Endereço</a> --}}
                    </div>
                    {{-- <hr>
                    <h3>Usuário desde: {{Auth::user()->created_at->format('d/m/Y')}}</h3>
                    <a href="/editar-perfil">Editar cadastro</a>
                    <a href="/adicionar-endereco">Meus Endereços</a> --}}

                </div>
            </div>
        </section>


        {{-- PARA TESTES --
            <div class="grid-container dash-pedido-produto margin-new">
            <div class="ult-pedidos bg-gray border-10 padding-detalhes">
                <div class="flex-container topo-secao">
                    <i class="fa-solid fa-square red"></i>
                    <h3>Pedidos Abertos</h3>
                </div>

                <div class="dashboard-tabela-pedidos">
                    @if (count($pedidos) > 0)

                        @foreach ($pedidos as $pedido)
                            <table class="tabela-geral">
                                <caption>Pedido: {{$pedido->id}}</caption>
                                <tr class="black">
                                    <th class="border-black padding-tabela-vh">Data e hora</th>
                                    <th class="border-black padding-tabela-vh">Pagamento</th>
                                    <th class="border-black padding-tabela-vh">Valor</th>
                                    <th class="border-black padding-tabela-vh">Status</th>
                                </tr>
                                <tr class="bg-white">
                                    <td class="border-black padding-tabela-vh">{{$pedido->created_at}}</td>
                                    <td class="border-black padding-tabela-vh">{{$pedido->pagamento_tipo}}</td>
                                    <td class="border-black padding-tabela-vh">R$ {{number_format($pedido->total_pedido,2,',','.')}}</td>
                                    <td class="border-black padding-tabela-vh">{{$pedido->status}}</td>
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

            </div>
            <div class= "todos-produtos bg-gray border-10 padding-detalhes">
                <div class="flex-container topo-secao">
                    <i class="fa-solid fa-square red"></i>
                    <h3>Produtos</h3>
                </div>

                <div class="dashboard-tabela-produtos">
                    @if (count($pedidos) > 0)

                    @foreach ($pedidos as $pedido)
                        <table class="tabela-geral">
                            <caption>Pedido: {{$pedido->id}}</caption>
                            <tr class="black">
                                <th class="border-black padding-tabela-vh">Data e hora</th>
                                <th class="border-black padding-tabela-vh">Pagamento</th>
                                <th class="border-black padding-tabela-vh">Valor</th>
                                <th class="border-black padding-tabela-vh">Status</th>
                            </tr>
                            <tr class="bg-white">
                                <td class="border-black padding-tabela-vh">{{$pedido->created_at}}</td>
                                <td class="border-black padding-tabela-vh">{{$pedido->pagamento_tipo}}</td>
                                <td class="border-black padding-tabela-vh">R$ {{number_format($pedido->total_pedido,2,',','.')}}</td>
                                <td class="border-black padding-tabela-vh">{{$pedido->status}}</td>
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

            </div>
        </div> --}}

        <div class="detalhes-descricao bg-gray border-10 padding-detalhes margin-new no-border-sm">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h3>Últimos Pedidos</h3>
            </div>

            <div class="perfil-tabela">
                @if (count($pedidos) > 0)

                    <table class="tabela-geral md-only">
                        <tr class="black">
                            <th class="border-black padding-tabela-vh">Cod. Pedido</th>
                            <th class="border-black padding-tabela-vh">Data e hora</th>
                            <th class="border-black padding-tabela-vh">Pagamento</th>
                            <th class="border-black padding-tabela-vh">Valor</th>
                            <th class="border-black padding-tabela-vh">Status</th>
                        </tr>
                        @foreach ($pedidos as $pedido)

                                <tr class="bg-white">
                                    <td class="border-black padding-tabela-vh">{{$pedido->id}}</td>
                                    <td class="border-black padding-tabela-vh">{{$pedido->created_at}}</td>
                                    @php
                                        if($pedido->pagamento_tipo == 'boleto'){
                                            $pedido->pagamento_tipo = 'Boleto';
                                        }
                                        if($pedido->pagamento_tipo == 'pag_seguro'){
                                            $pedido->pagamento_tipo = 'PagSeguro';
                                        }
                                        if($pedido->pagamento_tipo == 'pix'){
                                            $pedido->pagamento_tipo = 'Pix';
                                        }
                                    @endphp
                                    <td class="border-black padding-tabela-vh">{{$pedido->pagamento_tipo}}</td>
                                    <td class="border-black padding-tabela-vh">R$ {{number_format($pedido->total_pedido,2,',','.')}}</td>
                                    <td class="border-black padding-tabela-vh">{{$pedido->status}}</td>
                                </tr>
                        @endforeach
                    </table>

                    <a href="/meus-pedidos">
                        <button class="bt-red">Ver Todos os Pedidos</button>
                    </a>
                    {{-- <a href="/meus-pedidos">Ver Todos os Pedidos</a> --}}

                @else
                    <h2>Ainda não foram realizadas Compras</h2>
                @endif

            </div>

        </div>

        {{-- <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h3>Meus Pedidos</h3>
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
                        </tr>
                    </table>
                @endforeach

            @else
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2>Ainda não foram realizadas Compras</h2>
            @endif

        </div> --}}
    </section>
@endsection
