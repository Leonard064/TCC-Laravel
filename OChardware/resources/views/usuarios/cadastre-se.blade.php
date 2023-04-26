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

        <div class="grid-container auth bg-gray border-10">

            {{-- Cadastro --}}

            <div class="flex-container form">
                <h2>Cadastre-se</h2>
                <form action="/registrar" method="POST" enctype="multipart/form-data" class="grid-container form-cadastro">
                    @csrf
                    <div>
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Insira seu nome" class="teste-form">

                        @if ($errors->get('nome'))
                            @foreach ($errors->get('nome') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div>
                        <label for="sobrenome">Sobrenome:</label><br>
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="teste-form">

                        @if ($errors->get('sobrenome'))
                            @foreach ($errors->get('sobrenome') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div>
                        <label for="login">Login:</label>
                        <input type="text" name="login" id="login" placeholder="Login" class="teste-form" value="{{old('nome')}}">

                        @if ($errors->get('login'))
                            @foreach ($errors->get('login') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div>
                        <label for="cpf">CPF:</label><br>
                        <input type="text" name="cpf" id="cpf" placeholder="CPF (sem pontos e traços)" class="teste-form">

                        @if ($errors->get('cpf'))
                            @foreach ($errors->get('cpf') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div>
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email-logon" placeholder="Email" class="teste-form">

                        @if ($errors->get('email'))
                            @foreach ($errors->get('email') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div class="span-2">
                        <label for="foto">Imagem: (opcional)</label>
                        <input type="file" name="foto" id="foto">
                    </div>

                    <div class="span-2">
                        <label for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha-logon" placeholder="Senha (min. 6 digitos)" class="teste-form">

                        @if ($errors->first('senha'))
                            @foreach ($errors->get('senha') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div class="span-2">
                        <label for="teste-senha">Insira Novamente a senha:</label>
                        <input type="password" name="teste-senha" id="testa-senha-logon" placeholder="Insira novamente sua senha" class="teste-form">

                        @if ($errors->first('teste-senha'))
                            @foreach ($errors->get('teste-senha') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>

                    <div class="bt-auth span-2">
                        <button class="bt-red">Entrar</button>
                    </div>

                </form>
            </div>


        </div> {{-- FIM Grid-container --}}

    </section>
@endsection
