@extends('layouts.main')

@section('conteudo')
    <section class="flex-container corpo-detalhes">
        <div class="meus-pedidos bg-gray border-10 margin-new padding-detalhes">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h2>Meus Pedidos</h2>
            </div>

            <div class="tabela-meus-pedidos">
                @if (count($pedidos) > 0)
                    <table class="tabela-geral">
                        <tr class="black">
                            <th class="border-black">Data e hora</th>
                            <th class="border-black">Pagamento</th>
                            <th class="border-black">Valor</th>
                            <th class="border-black">Status</th>
                        </tr>
                    @foreach ($pedidos as $pedido)
                        <tr class="bg-white">
                            <td class="border-black">{{$pedido->created_at}}</td>
                            <td class="border-black">{{$pedido->pagamento_tipo}}</td>
                            <td class="border-black">{{$pedido->total_pedido}}</td>
                            <td class="border-black">{{$pedido->status}}</td>
                        </tr>
                    @endforeach
                    </table>
                @else
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <h2>Ainda não foram realizados Pedidos</h2>
                @endif
            </div>

        </div>
    </section>
@endsection
