@extends('layouts.main')

@section('title','Editar Cadastro')

@section('conteudo')
    <section class="flex-container corpo flex-form">

        <div class="grid-container form-creation bg-gray margin-new padding-detalhes border-10">
            <h1>Editar Cadastro</h1>
            <form action="/update-perfil" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- campos Login, Email e CPF são UNIQUE --}}

                {{-- <input type="text" name="login" id="login" placeholder="Login" class="input-full" value="{{$usuario->login}}"> --}}
                <input type="text" name="nome" id="nome" placeholder="Nome" class="input-full" value="{{$usuario->nome}}">
                <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="input-full" value="{{$usuario->sobrenome}}">
                {{-- <input type="text" name="cpf" id="cpf" placeholder="CPF" class="input-full"> --}}
                {{-- <input type="email" name="email" id="email-logon" placeholder="Email" class="input-full" value="{{$usuario->email}}"> --}}
                <br>
                <p>Deseja trocar de senha?</p>
                <a href="/alterar-senha">Faça Aqui</a>
                <br>
                <label for="foto">Imagem: (Padrão: {{$usuario->foto}})</label><br>
                <input type="file" name="foto" id="foto">
                <br>
                {{--
                <input type="password" name="senha" id="senha-logon" placeholder="Nova Senha" class="input-full">
                <input type="password" name="" id="testa-senha-logon" placeholder="Insira sua senha atual" class="input-full">
                --}}
                <button class="bt-red">Atualizar</button>
            </form>
        </div>

        {{-- <div class="grid-container forms margem">

            -- Editar Cadastro --

            <div class="flex-container form">

                <form action="/update-perfil" method="POST" enctype="multipart/form-data">
                    @csrf

                    -- campos Login, Email e CPF são UNIQUE --

                    -- <input type="text" name="login" id="login" placeholder="Login" class="input-full" value="{{$usuario->login}}"> --
                    <input type="text" name="nome" id="nome" placeholder="Nome" class="input-full" value="{{$usuario->nome}}">
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="input-full" value="{{$usuario->sobrenome}}">
                    -- <input type="text" name="cpf" id="cpf" placeholder="CPF" class="input-full"> --
                    -- <input type="email" name="email" id="email-logon" placeholder="Email" class="input-full" value="{{$usuario->email}}"> --
                    <br>
                    <label for="foto">Imagem: (Padrão: {{$usuario->foto}})</label>
                    <input type="file" name="foto" id="foto">
                    <br>
                    --
                    <input type="password" name="senha" id="senha-logon" placeholder="Nova Senha" class="input-full">
                    <input type="password" name="" id="testa-senha-logon" placeholder="Insira sua senha atual" class="input-full">
                    --
                    <button class="bt-red">Atualizar</button>
                </form>
            </div>

        </div> FIM Grid-container --}}

    </section>
@endsection
