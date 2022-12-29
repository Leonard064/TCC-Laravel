@extends('layouts.main')

@section('title','Editar Cadastro')

@section('conteudo')
    <section class="flex-container corpo">
        <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h2>Editar Cadastro</h2>
        </div>

        <div class="grid-container forms margem">

            {{-- Editar Cadastro --}}

            <div class="flex-container form">

                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="login" id="login" placeholder="Login" class="input-full" value="{{$usuario->login}}">
                    <input type="text" name="nome" id="nome" placeholder="Nome" class="input-full" value="{{$usuario->nome}}">
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="input-full" value="{{$usuario->sobrenome}}">
                    {{-- <input type="text" name="cpf" id="cpf" placeholder="CPF" class="input-full"> --}}
                    <input type="email" name="email" id="email-logon" placeholder="Email" class="input-full" value="{{$usuario->email}}">
                    <br>
                    <label for="foto">Imagem: (Padrão: {{$usuario->foto}})</label>
                    <input type="file" name="foto" id="foto" value="{{$usuario->foto}}">
                    <br>
                    {{--
                    <input type="password" name="senha" id="senha-logon" placeholder="Nova Senha" class="input-full">
                    <input type="password" name="" id="testa-senha-logon" placeholder="Insira sua senha atual" class="input-full">
                    --}}
                    <button class="bt-red">Atualizar</button>
                </form>
            </div>

        </div> {{-- FIM Grid-container --}}

    </section>
@endsection
