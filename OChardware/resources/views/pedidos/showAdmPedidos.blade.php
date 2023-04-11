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
                            <th class="border-black">Data e hora</th>
                            <th class="border-black">Pagamento</th>
                            <th class="border-black">Valor</th>
                            <th class="border-black">Status</th>
                            <th class="border-black">Opções</th>
                        </tr>
                    @foreach ($pedido as $pedidos)
                        <tr class="bg-white">
                            <td class="border-black">{{$pedidos->created_at}}</td>
                            <td class="border-black">{{$pedidos->pagamento_tipo}}</td>
                            <td class="border-black">{{$pedidos->total_pedido}}</td>
                            <td class="border-black" class="border-black">{{$pedidos->status}}</td>
                            <td class="border-black"><a href="/editar-pedido/{{$pedidos->id}}">Editar Status</a></td>
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
