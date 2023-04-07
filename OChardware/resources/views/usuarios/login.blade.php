@extends('layouts.main')

@section('title','OC Hardware - Entrar')

@section('conteudo')
    <section class="flex-container corpo flex-form">
        {{-- <div class="flex-container banner-login heading banner-texto">
            <h2>Não Possui cadastro? Faça agora o seu</h2>
        </div> --}}
        {{--<div class="flex-container secao black">
            <i class="fa-solid fa-square red"></i> &nbsp;
            <h2>Entre ou Cadastre-se</h2>
        </div>--}}

        <div class="grid-container auth bg-gray">


            {{-- Login --}}

            <div class="flex-container form">
                <h2>Login</h2>
                <form action="/entrar" method="POST">
                    @csrf
                    <input type="text" name="login" id="login" placeholder="Login" class="input-full">
                    <input type="password" name="senha" id="senha-login" placeholder="Senha" class="input-full">
                    <div class="flex-container bt-auth">
                        <button class="bt-red">Entrar</button>
                    </div>
                    <p>Não possui cadastro? <a href="/cadastre-se">Cadastrar</a></p>
                </form>
            </div>

        </div> {{-- FIM Grid-container --}}

    </section>
@endsection
