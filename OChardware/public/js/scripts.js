// Página de scripts da aplicação
// console.log('entrou')

function funcao(){
        var x = document.getElementById('mobile-nav')

        // alert(x)

        if(x.style.display === "block"){
            x.style.display = "none"
        }else{
            x.style.display = "block"
        }
    }

function funcaoUser(){
    var x = document.getElementById('mobile-nav-user')

    // alert(x)

    if(x.style.display === "block"){
        x.style.display = "none"
    }else{
        x.style.display = "block"
    }
}

// função para fechar as msgs de aviso
function fechaTeste(){
    document.getElementById('msg').setAttribute('style', 'display:none')
}


/*
    --- ÁREA DA PÁG. CHECKOUT ---
*/

//variáveis globais
var totalPAC;
var totalSEDEX;
var valCheck;

        var selecionaPac = function(){

            let hidd = document.createElement('input')
            hidd.type = 'hidden'
            hidd.name = 'frete_valor'
            hidd.value = totalPAC

            document.getElementById('frete').appendChild(hidd)

            mudaPreco(totalPAC)

            // alert("Input Criado!\n totalPAC: "+ totalPAC)
        }

        var selecionaSedex = function(){

            let hidd = document.createElement('input')
            hidd.type = 'hidden'
            hidd.name = 'frete_valor'
            hidd.value = totalSEDEX

            document.getElementById('frete').appendChild(hidd)

            mudaPreco(totalSEDEX)

            // alert("Input Criado\n totalSEDEX: "+ totalSEDEX)
        }

        function mudaPreco(preco){

            let parse = (parseFloat(valCheck) + parseFloat(preco)).toFixed(2)

            let soma = parse.replace(".", ",")

            // let soma2 = new Intl.NumberFormat().format(soma)

            document.querySelector(".label-preco").innerHTML = "R$" + soma

            let hiddValor = document.createElement('input')
            hiddValor.type = 'hidden'
            hiddValor.name = 'total_pedido'
            // hiddValor.value = parseFloat(t3) + parseFloat(preco)
            hiddValor.value = parseFloat(parse)

            document.getElementById('frete').appendChild(hiddValor)

            // alert("soma2")

        }

// função ajax para recuperar os valores de frete
function ajax(id,peso,total){

                valCheck = total;

                document.getElementById('frete').innerHTML = "Carregando...";

                // let corpo = document.querySelector('div.corpo');

                let url = '/api/frete/'+id+'/'+peso;
                // let idCep = id;

                fetch(url,{
                    'method': 'POST',
                    'headers':{'Content-Type':'application/json'},
                    //'params': JSON.stringify(idCep)
                }) //ajax
                    .then(response => response.json())
                    .then(responseBody => {

                        // div por enquanto é criada abaixo do corpo, logo não aparece

                         let div = document.getElementById('frete')

                         div.innerHTML = "";
                        //  div.id = 'frete'
                        // div.innerText = JSON.stringify(responseBody.data)

                        /*
                         * Pega os valores retornados
                         * e os salva em variaveis separadas
                         *
                        */
                        let tipoP =  responseBody.tipoPac
                        let valorP = responseBody.valorPac
                        let diasP =  responseBody.prazoPac

                        let tipoS = responseBody.tipoSedex
                        let valorS = responseBody.valorSedex
                        let diasS = responseBody.prazoSedex

                        //campos radio
                        let radio1 = document.createElement('input')
                        radio1.type = 'radio'
                        radio1.name = 'frete_tipo'
                        radio1.required = true
                        radio1.id = responseBody.tipoPac
                        radio1.value = responseBody.tipoPac

                        var label1 = document.createElement('label')
                        label1.htmlFor = 'pac'

                        var nvLinha1 = document.createElement('br')

                        var descricao1 = document.createTextNode( tipoP +' - R$'+ valorP +' - '+ diasP + ' Dias.');
                        label1.appendChild(descricao1)

                        // -------

                        let radio2 = document.createElement('input')
                        radio2.type = 'radio'
                        radio2.name = 'frete_tipo'
                        radio2.required = true
                        radio2.id = responseBody.tipoSedex
                        radio2.value = responseBody.tipoSedex

                        var label2 = document.createElement('label')
                        label2.htmlFor = 'sedex'

                        var nvLinha2 = document.createElement('br')

                        var descricao2 = document.createTextNode( tipoS +' - R$'+ valorS +' - '+ diasS + ' Dias.');
                        label2.appendChild(descricao2)

                        //salva o valor de cada serviço em uma variavel global
                        totalPAC = valorP
                        totalSEDEX = valorS

                        //chama os inputs na DOM
                        // document.getElementById('frete').appendChild(div)

                        div.appendChild(radio1)
                        div.appendChild(label1)
                        div.appendChild(nvLinha1)

                        div.appendChild(radio2)
                        div.appendChild(label2)
                        div.appendChild(nvLinha2)

                        //cria o listener para click nos radio buttons
                        radio1.addEventListener('click', selecionaPac)
                        radio2.addEventListener('click', selecionaSedex)

                    })

}
