@extends('layouts.main')

@section('title','Editar Produto')

@section('conteudo')
    <section class="flex-container corpo flex-form">

        <div class="grid-container auth bg-gray border-10">
            <div class="flex-form form">
                <h2>Editar Endereço</h2>

                <form action="/update-endereco" method="POST" class="grid-container form-cadastro">
                    @csrf

                    <div>
                        <label for="cep">Cep:</label>
                        <input type="text" name="cep" id="cep" placeholder="Sem traços" class="input-full" value="{{$endereco->cep}}">
                        @if ($errors->get('cep'))
                            @foreach ($errors->get('cep') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="endereço">Endereço:</label>
                        <input type="text" name="endereco" id="endereco" placeholder="Sem números" class="input-full"value="{{$endereco->endereco}}">
                         @if ($errors->get('endereco'))
                            @foreach ($errors->get('endereco') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="numero">Número:</label>
                        <input type="text" name="numero" id="numero" placeholder="Número" class="input-full" value="{{$endereco->numero}}">
                         @if ($errors->get('numero'))
                            @foreach ($errors->get('numero') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" id="bairro" placeholder="Bairro" class="input-full" value="{{$endereco->bairro}}">
                         @if ($errors->get('bairro'))
                            @foreach ($errors->get('bairro') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <input type="text" name="estado" id="estado" placeholder="Estado" class="input-full" value="{{$endereco->estado}}">
                         @if ($errors->get('estado'))
                            @foreach ($errors->get('estado') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>
                    <div>
                        <label for="municipio">Município:</label>
                        <input type="text" name="municipio" id="municipio" placeholder="municipio" class="input-full" value="{{$endereco->municipio}}">
                         @if ($errors->get('municipio'))
                            @foreach ($errors->get('municipio') as $err)
                                <p class="err-form">{{$err}}</p><br>
                            @endforeach

                        @endif
                    </div>

                    <input type="hidden" name="id" value="{{$endereco->id}}">

                    <div class="flex-container bt-auth span-2">
                        <button class="bt-red">Atualizar Endereço</button>

                    </div>

                </form>
            </div>

        </div>
    </section>
@endsection
