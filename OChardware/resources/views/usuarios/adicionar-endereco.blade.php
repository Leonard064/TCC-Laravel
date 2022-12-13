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

                            <ul>
                            @foreach ($enderecos as $endereco)

                               <li>{{$endereco->endereco}}</li>

                            @endforeach
                            </ul>

                        @else
                            <h3>Você ainda não possui endereço cadastrado.</h3>
                        @endif

                </div>
            </div>
        </section>

        <div class="flex-container secao black">
            <h3>Adicionar Novo Endereço</h3>
        </div>

        <div class="flex-container corpo margem">
            <form action="/endereco/create" method="post">
                @csrf


                <input type="text" name="cep" id="cep" placeholder="cep">
                <input type="text" name="endereco" id="endereco" placeholder="endereco">
                <input type="text" name="numero" id="numero" placeholder="numero">
                <input type="text" name="bairro" id="bairro" placeholder="bairro">
                <input type="text" name="estado" id="estado" placeholder="estado">
                <input type="text" name="municipio" id="municipio" placeholder="municipio">

                <button class="bt-red">Adicionar</button>

            </form>
        </div>

    </section>

@endsection
