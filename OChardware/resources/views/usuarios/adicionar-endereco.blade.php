@extends('layouts.main')

@section('Teste')

@section('conteudo')
    <section class="flex-container corpo-detalhes">
        <section class="detalhes-topo">
            <div class="grid-container detalhes-foto-nome margem">
                <div class="flex-container detalhes-nome">
                    <h2>Meus Endereços</h2>
                    <hr>

                        @if (count($enderecos) > 0)

                            <table>
                                <tr>
                                    <th>Endereço</th>
                                    <th>Estado</th>
                                </tr>

                                    @foreach ($enderecos as $endereco)

                                        <td>{{$endereco->endereco}}</td>
                                        <td>{{$endereco->estado}}</td>
                                        <td><a href="/editar-endereco/{{$endereco->id}}">Editar</a></td>
                                        <td><a href="/remover-endereco/{{$endereco->id}}">Excluir</a></td>

                                    @endforeach
                            </table>

                        @else
                            <h3>Você ainda não possui endereço cadastrado.</h3>
                        @endif

                </div>
            </div>
        </section>

        <div class="flex-container secao black">
            <h3>Adicionar Novo Endereço</h3>
        </div>

        <div class="grid-container forms margem">

            {{-- Endereços Salvos --}}

            <div class="flex-container form">

                <form action="/endereco/create" method="POST">
                    @csrf

                    <input type="text" name="cep" id="cep" placeholder="cep" class="input-full">
                    <input type="text" name="endereco" id="endereco" placeholder="endereco" class="input-full">
                    <input type="text" name="numero" id="numero" placeholder="numero" class="input-full">
                    <input type="text" name="bairro" id="bairro" placeholder="bairro" class="input-full">
                    <input type="text" name="estado" id="estado" placeholder="estado" class="input-full">
                    <input type="text" name="municipio" id="municipio" placeholder="municipio" class="input-full">


                    <button class="bt-red">Adicionar</button>

                </form>
            </div>

        </div>

    </section>

@endsection
