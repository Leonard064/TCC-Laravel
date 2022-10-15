@extends('layouts.main')

@section('title', 'Carrinho - OCHardware')

@section('conteudo')
    <div class="flex-container corpo margem">
        <h1>Página Carrinho</h1>

        <table>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </tr>
            <tr>
                <td>img.png</td>
                <td>Loren Ipsum</td>
                <td>1</td>
                <td>R$1159,99</td>
            </tr>

        </table>
    </div>

@endsection
