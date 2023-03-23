@extends('layouts.main')

@section('title','OC Hardware - Cadastre-se')

@section('conteudo')
    <section class="flex-container corpo flex-form">
        {{-- <div class="flex-container banner-login heading banner-texto">
            <h2>Não Possui cadastro? Faça agora o seu</h2>
        </div> --}}
        {{-- <div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h2>Entre ou Cadastre-se</h2>
        </div> --}}

        <div class="grid-container auth">

            {{-- Cadastro --}}

            <div class="flex-container form">
                <h2>Cadastre-se</h2>
                <form action="/registrar" method="POST" enctype="multipart/form-data" class="form-cadastro">
                    @csrf
                    <input type="text" name="nome" id="nome" placeholder="Nome" class="teste-form">
                    <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="teste-form">
                    <input type="text" name="login" id="login" placeholder="Login" class="teste-form">
                    <input type="text" name="cpf" id="cpf" placeholder="CPF" class="teste-form">
                    <input type="email" name="email" id="email-logon" placeholder="Email" class="teste-form">
                    <br><br>
                    <label for="foto">Imagem:</label>
                    <input type="file" name="foto" id="foto">
                    <br><br>
                    <input type="password" name="senha" id="senha-logon" placeholder="Senha" class="teste-form">
                    <input type="password" name="" id="testa-senha-logon" placeholder="Insira novamente sua senha" class="teste-form">

                    <div class="flex-container bt-auth">
                        <button class="bt-red">Entrar</button>
                    </div>

                </form>
            </div>


        </div> {{-- FIM Grid-container --}}

    </section>
@endsection
