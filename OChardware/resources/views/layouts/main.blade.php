<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Overclock® Hardware - Dê um OverClock!</title>
        <link rel="stylesheet" href="../css/estilo.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter&family=Passion+One&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="../fontawesome/css/all.css">
    </head>
    <body>
        <header>
            <section class="black">
                <div class="flex-container topo margem">
                    <div>
                        <a href="/">
                            <img src="../img/logo.png" alt="OverClock">
                        </a>
                    </div>
                    <div id="topo-pesquisa">
                        <form action="/produtos" method="GET">
                            <input type="text" name="pesquisa" placeholder="Pesquise por produtos...">
                        </form>
                    </div>
                    <div>
                        <span>
                            <a class="no-deco-white" href="/login"> Entre ou Cadastre-se</a>
                        </span>
                    </div>
                </div>
            </section>
                <section class="flex-container topo-mobile black">
                    <div class="logo-mobile">
                        <a href="/">
                            <img src="../img/logo.png" alt="OverClock">
                        </a>
                    </div>
                    <div class="flex-container menu-dir">
                        <i class="fa fa-bars fa-2xl" onclick="funcao()"></i>
                     </div>
                </section>
                <section id="mobile-nav" class="black">
                    <ul>
                        <li>
                            <a class="no-deco-white" href="/produtos/processador">Processadores</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/placa_mae">Placas-Mãe</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/placa_de_video">Placas de Vídeo</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/memoria">Memórias</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/monitor">Monitores</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/mouse_teclado">Mouse e Teclado</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/hd">HD</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/ssd">SSD</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="produtos/fonte">Fontes</a>
                        </li>
                    </ul>
                </section>
        </header>
        <nav>
            <section class="flex-container navegacao black">
                <div>
                    <ul>
                        <li>
                            <a class="no-deco-white" href="/produtos/processador">Processadores</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/placa_mae">Placas-Mãe</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/placa_de_video">Placas de Vídeo</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/memoria">Memórias</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/monitor">Monitores</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/mouse_teclado">Mouse e Teclado</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/hd">HD</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="/produtos/ssd">SSD</a>
                        </li>
                        <li>
                            <a class="no-deco-white" href="produtos/fonte">Fontes</a>
                        </li>
                    </ul>
                </div>
            </section>
        </nav>
        <main>
            @yield('conteudo')
        </main>
        <footer>
            <section class="flex-container rodape black">
                <section class="flex-container rodape-secao1">
                    <div class="rodape-secao1-info">
                        <h4>Siga nossos perfis</h4>
                        <span class="fa-brands fa-facebook fa-2xl"></span>
                        <span class="fa-brands fa-instagram fa-2xl"></span>
                        <span class="fa-brands fa-twitter fa-2xl"></span>
                    </div>
                </section>
                <section class="grid-container rodape-secao2">
                    <div class="rodape-secao2-esquerda">
                        <h4>Overclock® - Remodel by L064 - original de BRANDO INDUSTRIES</h4>
                        <p>Preços e condições de pagamento exclusivos para compras via internet e podem variar nas lojas físicas. Os preços anunciados neste site ou via e-mail promocional podem ser alterados sem prévio aviso. A Overclock®, não é responsável por erros descritivos. As fotos contidas nesta página são meramente ilustrativas do produto e podem variar de acordo com o fornecedor/lote do fabricante. Ofertas válidas até o término de nossos estoques. Vendas sujeitas à análise e confirmação de dados.</p>
                    </div>
                    <div class="grid-container rodape-secao2-meio">
                        <div>
                            <h4>Formas de Pagamento</h4>
                            <img src="../img/boleto.png" alt="">
                            <img src="../img/hipercard.png" alt="">
                            <img src="../img/master.png" alt="">
                            <!-- <img src="img/paypal.jpg" alt=""> -->
                        </div>
                        <div>
                            <h5>2021/2022 - Leonard064.</h5>
                        </div>
                    </div>
                    <div class="grid-container rodape-secao2-direita">
                        <div>
                            <h4>Contato</h4>
                            <p>SAC - (21) 9999 - 9999</p>
                            <p>Email - atendimetooc@email.com</p>
                            <h4>Horário de Funcionamento</h4>
                            <p>Loja Física: de seg a sex - 08:00 às 21:00</p>
                        </div>
                    </div>
                </section>
            </section>
        </footer>
    </body>
</html>
<script>
    function funcao(){
        var x = document.getElementById('mobile-nav')

        // alert(x)

        if(x.style.display === "block"){
            x.style.display = "none"
        }else{
            x.style.display = "block"
        }
    }
</script>
