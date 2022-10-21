@extends('layouts.main')

@section('title','criar produto')

@section('conteudo')
    <section class="flex-container form">
        <form action="/produtos/create" method="POST" enctype="multipart/form-data">
            @csrf
            <!--input type="text" name="nome" id="nome" placeholder="Nome" class="input-full"-->

            <input type="text" name="nome" id="nome" placeholder="nome" class="input-full">

            <label for="categoria">Categoria</label>
            <select name="categoria" id="categoria" class="input-full">
                <option value="processador">Processadores</option>
                <option value="placa_mae">Placas-Mãe</option>
                <option value="placa_de_video">Placas de Vídeo</option>
                <option value="memoria">Memórias</option>
                <option value="monitor">Monitores</option>
                <option value="mouse_teclado">Mouse e Teclado</option>
                <option value="hd">HD</option>
                <option value="ssd">SSD</option>
                <option value="fonte">Fontes</option>
            </select>

            <input type="text" name="preco" id="preco" placeholder="Preço" class="input-full">

            <label for="descricao">Descrição: </label>
            <textarea name="descricao" id="descricao" cols="80" rows="10"></textarea>
            <br>
            <label for="foto">Imagem:</label>
            <input type="file" name="foto" id="foto">
            <br>
            <input type="text" name="largura" id="largura" placeholder="largura" class="input-full">
            <input type="text" name="altura" id="altura" placeholder="altura" class="input-full">
            <input type="text" name="peso" id="peso" placeholder="peso" class="input-full">
            <input type="text" name="comprimento" id="comprimento" placeholder="comprimento" class="input-full">
            <input type="text" name="quantidade" id="quantidade" placeholder="quantidade" class="input-full">

            <button class="bt-red">Adicionar</button>
        </form>
    </section>
@endsection
