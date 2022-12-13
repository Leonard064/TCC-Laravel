@extends('layouts.main')

@section('title','OC Hardware - Cadastre-se')

@section('conteudo')
    <section class="flex-container corpo">
        <div class="flex-container banner-login heading banner-texto">
            <h2>Não Possui cadastro? Faça agora o seu</h2>
        </div>
        <div class="flex-container secao">
            <h2>Entre ou Cadastre-se</h2>
        </div>

        <div class="grid-container forms margem">

            {{-- Cadastro --}}

            <div class="flex-container form">
                <h3>Cadastre-se</h3>
                <form action="/registrar" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="login" id="login" placeholder="Login" class="input-full">
                    <input type="text" name="nome" id="nome" placeholder="Nome" class="input-full">
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="input-full">
                    <input type="text" name="cpf" id="cpf" placeholder="CPF" class="input-full">
                    <input type="email" name="email" id="email-logon" placeholder="Email" class="input-full">
                    <br>
                    <label for="foto">Imagem:</label>
                    <input type="file" name="foto" id="foto">
                    <br>
                    <input type="password" name="senha" id="senha-logon" placeholder="Senha" class="input-full">
                    <input type="password" name="" id="testa-senha-logon" placeholder="Insira novamente sua senha" class="input-full">
                    <button class="bt-red">Cadastrar</button>
                </form>
            </div>

        </div> {{-- FIM Grid-container --}}

    </section>
@endsection
