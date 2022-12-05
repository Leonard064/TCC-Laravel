@extends('layouts.main')

@section('title','criar produto')

@section('conteudo')
    <section class="margem">
        <h2>Adicionar Categoria</h2>
        <div class="flex-container form">
            <form action="/categorias/create" method="post">
                @csrf

                <input type="text" name="nome" id="nome" placeholder="Nome da Categoria" class="input-full">

                <button class="bt-red">Adicionar</button>
            </form>
        </div>
    </section>
@endsection
