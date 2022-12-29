@extends('layouts.main')

@section('title','Todos os Produtos')

@section('conteudo')
    <section class="flex-container corpo">
        <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h2>Todos os Produtos</h2>
        </div>
        <div class="flex-container margem">

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

        </div>
    </section>
@endsection
