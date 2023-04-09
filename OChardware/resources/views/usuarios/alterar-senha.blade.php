@extends('layouts.main')

@section('conteudo')
    <section class="flex-container corpo flex-form">
        <div class="grid-container form-creation bg-gray margin-new border-10 padding-detalhes">
            <h1>Alterar Senha</h1>

            <form action="/update-senha" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="password" name="" id="testa-senha-logon" placeholder="Insira sua senha atual" class="input-full">
                <input type="password" name="senha" id="senha-logon" placeholder="Nova Senha" class="input-full">

                <button class="bt-red">Atualizar</button>
            </form>
        </div>
        </div>
    </section>
@endsection
