@extends('layouts.main')

@section('Teste')

@section('conteudo')
    <section class="flex-container corpo">

        <div class="detalhes-topo bg-gray border-10 margin-new padding-detalhes">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h2>Meus Endereços</h2>
            </div>

            <div class="tabela-enderecos">
                @if (count($enderecos) > 0)

                    <table class="tabela-geral">
                        <tr class="border-white">
                            <th class="padding-tabela-vh">Endereço</th>
                            <th class="padding-tabela-vh">Estado</th>
                            <th class="padding-tabela-vh">Opções</th>
                        </tr>

                            @foreach ($enderecos as $endereco)
                                <tr class="border-white">
                                    <td class="padding-tabela-vh">{{$endereco->endereco}}</td>
                                    <td class="padding-tabela-vh">{{$endereco->estado}}</td>
                                    <td class="padding-tabela-vh"><a href="/editar-endereco/{{$endereco->id}}">Editar</a>
                                    <a href="/remover-endereco/{{$endereco->id}}">Excluir</a></td>
                                </tr>
                            @endforeach
                    </table>

                @else
                    <h3>Você ainda não possui endereço cadastrado.</h3>
                @endif

            </div>

        </div>

        <div class="edit-endereco bg-gray margin-new padding-detalhes border-10">
            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h2>Adicionar novo Endereço</h2>
            </div>

            <div>
                <form action="/endereco/create" method="POST" class="grid-container form-edit-endereco">
                    @csrf

                    <div>
                        <label for="cep">Cep:</label>
                        <input type="text" name="cep" id="cep" placeholder="Sem traços" class="input-full">
                        @if ($errors->get('cep'))
                            @foreach ($errors->get('cep') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="endereço">Endereço:</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Sem números" class="input-full">
                         @if ($errors->get('endereco'))
                            @foreach ($errors->get('endereco') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numero" placeholder="Número" class="input-full">
                         @if ($errors->get('numero'))
                            @foreach ($errors->get('numero') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" placeholder="Bairro" class="input-full">
                         @if ($errors->get('bairro'))
                            @foreach ($errors->get('bairro') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <input type="text" name="estado" id="estado" placeholder="Estado" class="input-full">
                         @if ($errors->get('estado'))
                            @foreach ($errors->get('estado') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="municipio">Município:</label>
                        <input type="text" name="municipio" id="municipio" placeholder="municipio" class="input-full">
                         @if ($errors->get('municipio'))
                            @foreach ($errors->get('municipio') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <button class="bt-red">Adicionar</button>
                    </div>

                </form>
            </div>

        </div>

@endsection
