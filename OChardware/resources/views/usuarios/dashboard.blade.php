@extends('layouts.main')

@section('title','OC - Admin')

@section('conteudo')
    <div class="flex-container corpo margem">
        <div>
            <h1>Admin</h1>
            <a href="/create-categoria">Criar Categoria</a>
            <a href="/create-marca">Criar Marca</a>
            <a href="/create-produto">Criar Produto</a>
        </div>

        <div class="flex-container secao">
            <h3>Pedidos Abertos</h3>
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
                            <td><a href="#">Editar Status</a></td>
                        </tr>
                    </table>
                @endforeach

            @else
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2>Ainda não foram realizados Pedidos</h2>
            @endif
        </div>

    </div>

@endsection
