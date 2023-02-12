@extends('layouts.main')

@section('title', 'Meu Perfil - OCHardware')

@section('conteudo')
    <section class="flex-container corpo-detalhes">
        <section class="detalhes-topo">
            <div class="grid-container detalhes-foto-nome margem">
                <div class="flex-container detalhes-foto">
                    <img src="img/usuarios/{{Auth::user()->foto}}" alt="Perfil">
                </div>
                <div class="flex-container detalhes-nome">
                    <h2>{{Auth::user()->nome}} {{Auth::user()->sobrenome}}</h2>
                    <hr>
                    <h3>Usuário desde: {{Auth::user()->created_at->format('d/m/Y')}}</h3>
                    <a href="/editar-perfil">Editar cadastro</a>
                    <a href="/adicionar-endereco">Meus Endereços</a>

                </div>
            </div>
        </section>

        <div class="flex-container secao black">
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

        </div>
    </section>
@endsection
