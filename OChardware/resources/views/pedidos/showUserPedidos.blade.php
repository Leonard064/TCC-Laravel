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
                            <th class="border-black padding-tabela-vh">Data e hora</th>
                            <th class="border-black padding-tabela-vh">Pagamento</th>
                            <th class="border-black padding-tabela-vh">Valor</th>
                            <th class="border-black padding-tabela-vh">Status</th>
                        </tr>
                    @foreach ($pedidos as $pedido)
                        <tr class="bg-white">
                            <td class="border-black padding-tabela-vh">{{$pedido->created_at}}</td>
                            <td class="border-black padding-tabela-vh">{{$pedido->pagamento_tipo}}</td>
                            <td class="border-black padding-tabela-vh">{{$pedido->total_pedido}}</td>
                            <td class="border-black padding-tabela-vh">{{$pedido->status}}</td>
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
