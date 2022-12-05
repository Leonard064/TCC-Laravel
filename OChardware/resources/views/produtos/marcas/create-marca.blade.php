@extends('layouts.main')

@section('title','criar produto')

@section('conteudo')
    <section class="margem">
        <h2>Adicionar Marca</h2>
        <div class="flex-container form">
            <form action="/marcas/create" method="post">
                @csrf

                <input type="text" name="nome" id="nome" placeholder="Nome da Marca" class="input-full">

                <button class="bt-red">Adicionar</button>
            </form>
        </div>
    </section>
@endsection
