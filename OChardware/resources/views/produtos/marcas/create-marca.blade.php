@extends('layouts.main')

@section('title','criar produto')

@section('conteudo')
    <section class="flex-container corpo flex-form">
        <div class="grid-container form-creation bg-gray margin-new padding-detalhes">

            <h1>Adicionar Marca</h1>

            <form action="/marcas/create" method="post">
                @csrf

                <label for="nome">Marca:</label>
                <input type="text" name="nome" id="nome" placeholder="Nome da Marca" class="input-full">
                @if ($errors->get('nome'))
                    @foreach ($errors->get('nome') as $err)
                        <p class="err-form">{{$err}}</p>
                    @endforeach
                @endif

                <button class="bt-red">Adicionar</button>
            </form>

        </div>

    </section>
@endsection
