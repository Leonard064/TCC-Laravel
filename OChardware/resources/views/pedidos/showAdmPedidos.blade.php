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
                    <table>
                        <tr>
                            <th>Data e hora</th>
                            <th>Pagamento</th>
                            <th>Valor</th>
                            <th>Status</th>
                        </tr>
                    @foreach ($pedido as $pedidos)
                        <tr>
                            <td>{{$pedidos->created_at}}</td>
                            <td>{{$pedidos->pagamento_tipo}}</td>
                            <td>{{$pedidos->total_pedido}}</td>
                            <td>{{$pedidos->status}}</td>
                            <td><a href="/editar-pedido/{{$pedidos->id}}">Editar Status</a></td>
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
