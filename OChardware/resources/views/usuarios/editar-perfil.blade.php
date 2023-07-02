@extends('layouts.main')

@section('title','Editar Cadastro')

@section('conteudo')
    <section class="flex-container corpo flex-form">

        <div class="grid-container auth bg-gray border-10">
            <div class="flex-form form">
                <h2>Editar Dados</h2>

                <form action="/update-perfil" method="post" enctype="multipart/form-data" class="grid-container form-cadastro">
                @csrf
                    <div>
                        <label for="nome">Nome:</label>
                        <input type="text" name="nome" id="nome" placeholder="Nome" class="input-full" value="{{$usuario->nome}}">
                        @if ($errors->get('nome'))
                            @foreach ($errors->get('nome') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div>
                        <label for="sobrenome">Sobrenome:</label>
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="Sobrenome" class="input-full" value="{{$usuario->sobrenome}}">
                        @if ($errors->get('sobrenome'))
                            @foreach ($errors->get('sobrenome') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div class="span-2">
                        <label for="login">Login:</label>
                        <input type="text" name="login" id="login" placeholder="Login" class="input-full" value="{{$usuario->login}}">
                        @if ($errors->get('login'))
                        @foreach ($errors->get('login') as $err)
                            <p class="err-form">{{$err}}</p><br>
                        @endforeach

                        @endif

                    </div>
                    <div class="span-2">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email-logon" placeholder="Email" class="input-full" value="{{$usuario->email}}">
                        @if ($errors->get('email'))
                            @foreach ($errors->get('email') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif

                    </div>
                    <div class="span-2">
                        <p>Deseja trocar de senha? <a href="/alterar-senha">Faça Aqui</a></p>
                    </div>
                    <div class="span-2">
                        <label for="foto">Imagem Atual: </label><br>
                        <img src="img/usuarios/{{Auth::user()->foto}}" class="img-edit" alt="foto">
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div class="flex-container bt-auth span-2">
                        <button class="bt-red">Atualizar</button>
                    </div>

                </form>
            </div>

        </div>
    </section>
@endsection
