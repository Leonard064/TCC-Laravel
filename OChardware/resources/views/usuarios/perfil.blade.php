@extends('layouts.main')

@section('title', 'Meu Perfil - OCHardware')

@section('conteudo')
    <section class="flex-container corpo">
        <section class="detalhes-topo bg-gray border-10 margin-new">
            <div class="grid-container detalhes-foto-nome">
                <div class="flex-container perfil-foto">
                    <img src="img/usuarios/{{Auth::user()->foto}}" class="border-10" alt="Perfil">
                </div>
                <div class="flex-container detalhes-nome">
                    <h1>{{Auth::user()->nome}} {{Auth::user()->sobrenome}}</h1>
                    <div class="flex-container perfil-opcoes">
                        <a href="/editar-perfil">Editar Cadastro</a>&nbsp;
                        <a href="/editar-perfil">Alterar Senha</a>&nbsp;
                        <a href="/editar-perfil">Meus Pedidos</a>&nbsp;
                        <a href="/adicionar-endereco">Meus Endereços</a>
                    </div>
                    {{-- <hr>
                    <h3>Usuário desde: {{Auth::user()->created_at->format('d/m/Y')}}</h3>
                    <a href="/editar-perfil">Editar cadastro</a>
                    <a href="/adicionar-endereco">Meus Endereços</a> --}}

                </div>
            </div>
        </section>

        <div class="detalhes-descricao bg-gray border-10 padding-detalhes margin-new">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h3>Últimos Pedidos</h3>
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
                        </tr>
                    </table>
                @endforeach

                <a href="#">Ver Todos os Pedidos</a>

            @else
                <i class="fa-solid fa-triangle-exclamation"></i>
                <h2>Ainda não foram realizadas Compras</h2>
            @endif


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
