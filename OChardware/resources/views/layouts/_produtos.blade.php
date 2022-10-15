    @foreach($produto as $produto)
        <div class="card">
            <div class="flex-container card-img">
                <a href="/detalhes/{{$produto->id}}">
                    <img src="../img/produtos/{{$produto->foto}}" alt="{{$produto->nome}}">
                </a>
            </div>
            <div class="preco">
                <h3>{{$produto->nome}}</h3>
                <span>{{$produto->nome}}</span>
            </div>
            <div class="comprar">
                <span>R${{$produto->preco}}</span>
                <button class="bt-red">Comprar</button>
            </div>
        </div>
    @endforeach

