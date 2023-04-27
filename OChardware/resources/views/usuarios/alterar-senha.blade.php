@extends('layouts.main')

@section('conteudo')
    <section class="flex-container corpo flex-form">

        <div class="grid-container auth bg-gray border-10">
            <div class="flex-form form">
                <h2>Alterar Senha</h2>

                <form action="/update-senha" method="POST">
                @csrf

                    <div class="span-2">
                        <label for="senha">Senha Atual:</label>
                        <input type="password" name="senha" id="senha" placeholder="Insira sua senha atual" class="input-full">
                        @if ($errors->get('senha'))
                            @foreach ($errors->get('senha') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div class="span-2">
                        <label for="senha-nova">Nova Senha:</label>
                        <input type="password" name="senha-nova" id="senha-nova" placeholder="Insira sua nova senha" class="input-full">
                        @if ($errors->get('senha-nova'))
                            @foreach ($errors->get('senha-nova') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    @if($message = Session::get('error'))
                        <div class=" flex-container bt-auth span-2">
                            <p class="err-form"><div class=" flex-container bt-auth span-2">
                                <p class="err-form">{{$message}}</p>
                            </div>
                        </div>
                    @endif

                    <div class="flex-container bt-auth span-2">
                        <button class="bt-red">Atualizar</button>
                    </div>

                </form>
            </div>
        </div>

        {{-- <div class="grid-container form-creation bg-gray margin-new border-10 padding-detalhes">
            <h1>Alterar Senha</h1>

            <form action="/update-senha" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="password" name="" id="testa-senha-logon" placeholder="Insira sua senha atual" class="input-full">
                <input type="password" name="senha" id="senha-logon" placeholder="Nova Senha" class="input-full">

                <button class="bt-red">Atualizar</button>
            </form>
        </div> --}}
        </div>
    </section>
@endsection
