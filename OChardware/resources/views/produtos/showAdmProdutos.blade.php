@extends('layouts.main')

@section('title','Todos os Produtos')

@section('conteudo')
    <section class="flex-container corpo-detalhes">

        <div class="todos-produtos bg-gray border-10 margin-new padding-detalhes">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h2>Todos os Produtos</h2>
            </div>

            <div id="tabela-todos-produtos">
                @if(count($produto) > 0)
                <table class="tabela-geral">
                    <tr class="black">
                        <th class="border-black">Foto</th>
                        <th class="border-black">Nome</th>
                        <th class="border-black">Quantidade</th>
                        <th class="border-black">Valor</th>
                        <th class="border-black">Opções</th>
                    </tr>

                    @foreach ($produto as $produtos)
                        <tr class="bg-white">
                            <td class="border-black">{{$produtos->foto}}</td>
                            <td class="border-black">{{$produtos->nome}}</td>
                            <td class="border-black">{{$produtos->quantidade}}</td>
                            <td class="border-black">{{$produtos->preco}}</td>
                            <td class="border-black"><a href="/editar-produto/{{$produtos->id}}">Editar</a>
                            <a href="/remover-produto/{{$produtos->id}}">Excluir</a></td>
                        </tr>
                    @endforeach

                </table>

            @else
                <h3>Não há produtos</h3>

            @endif
            </div>

        </div>


        {{-- <div class="flex-container margem">

            @if(count($produto) > 0)
                <table>
                    <tr>
                        <th>Foto</th>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Valor</th>
                    </tr>

                    @foreach ($produto as $produtos)
                        <tr>
                            <td>{{$produtos->foto}}</td>
                            <td>{{$produtos->nome}}</td>
                            <td>{{$produtos->quantidade}}</td>
                            <td>{{$produtos->preco}}</td>
                            <td><a href="/editar-produto/{{$produtos->id}}">Editar</a></td>
                            <td><a href="/remover-produto/{{$produtos->id}}">Excluir</a></td>
                        </tr>
                    @endforeach

                </table>

            @else
                <h3>Não há produtos</h3>

            @endif

        </div> --}}
    </section>
@endsection
