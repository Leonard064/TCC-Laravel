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
                <form action="/addCarrinho" method="post">
                    @csrf
                    <input type="hidden" name="id" value="{{$produto->id}}">
                    <button class="bt-red">Comprar</button>
                </form>
            </div>
        </div>
    @endforeach

