@extends('layouts.main')

@section('title','todos os pedidos')

@section('conteudo')
    <section class="flex-container corpo">

        <div class="todos-pedidos bg-gray border-10 margin-new padding-detalhes">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h2>Todos os Pedidos</h2>
            </div>

            <div id="tabela-todos-pedidos">
                @if (count($pedido) > 0)
                    <table class="tabela-geral">
                        <tr class="black">
                            <th class="border-black padding-tabela-vh">Cod. Pedido</th>
                            <th class="border-black padding-tabela-vh">Data e hora</th>
                            <th class="border-black padding-tabela-vh">Pagamento</th>
                            <th class="border-black padding-tabela-vh">Valor</th>
                            <th class="border-black padding-tabela-vh">Status</th>
                            <th class="border-black padding-tabela-vh">Opções</th>
                        </tr>
                    @foreach ($pedido as $pedidos)
                        <tr class="bg-white">
                            <td class="border-black padding-tabela-vh">{{$pedidos->id}}</td>
                            <td class="border-black padding-tabela-vh">{{$pedidos->created_at}}</td>
                            <td class="border-black padding-tabela-vh">{{$pedidos->pagamento_tipo}}</td>
                            <td class="border-black padding-tabela-vh">{{$pedidos->total_pedido}}</td>
                            <td class="border-black padding-tabela-vh" class="border-black">{{$pedidos->status}}</td>
                            <td class="border-black padding-tabela-vh"><a href="/editar-pedido/{{$pedidos->id}}">Editar Status</a></td>
                        </tr>
                    @endforeach
                    </table>
                @else
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <h2>Ainda não foram realizados Pedidos</h2>
                @endif
            </div>
        </div>

        {{-- @if (count($pedido) > 0)

                @foreach ($pedido as $pedido)
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

            @else
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2>Ainda não foram realizados Pedidos</h2>
            @endif --}}
    </section>
@endsection
