@extends('layouts.main')

@section('title','Editar Produto')

@section('conteudo')
    <section class="flex-container corpo flex-form">
        <div class="grid-container form-edit-endereco bg-gray border-10 margin-new padding-detalhes">

            <div class="flex-container topo-secao">
                <i class="fa-solid fa-square red"></i>
                <h1>Editar Cadastro</h1>
            </div>

                <form action="/update-endereco" method="POST" class="form-50">
                    @csrf

                    <input type="text" name="cep" id="cep" placeholder="cep" class="input-full" value="{{$endereco->cep}}">
                    <input type="text" name="endereco" id="endereco" placeholder="endereco" class="input-full" value="{{$endereco->endereco}}">
                    <input type="text" name="numero" id="numero" placeholder="numero" class="input-full" value="{{$endereco->numero}}">
                    <input type="text" name="bairro" id="bairro" placeholder="bairro" class="input-full" value="{{$endereco->bairro}}">
                    <input type="text" name="estado" id="estado" placeholder="estado" class="input-full" value="{{$endereco->estado}}">
                    <input type="text" name="municipio" id="municipio" placeholder="municipio" class="input-full" value="{{$endereco->municipio}}">


                    <input type="hidden" name="id" value="{{$endereco->id}}">

                    <button class="bt-red">Atualizar Endereço</button>

                </form>

        </div>

    </section>
@endsection
