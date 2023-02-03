<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;
use App\Models\Endereco;
use App\Http\Controllers\Prod_CarrinhoController;

class FreteController extends Controller
{

    //API de retorno de fretes
    public function calculoFrete($id, $peso){

        try {
            $frete = Endereco::findOrFail($id);

            $calculoFrete = new PrecoPrazo();
            $calculoFrete->setCodigoServico([Data::PAC])
                    ->setCodigoEmpresa('08082650')
                    ->setSenha('564321')
                    ->setCepOrigem('07500000')
                    ->setCepDestino($frete->cep)
                    ->setComprimento(30)
                    ->setAltura(30)
                    ->setLargura(30)
                    ->setDiametro(30)
                    ->setPeso($peso);

                try {
                    //cria uma pesquisa para PAC
                    //clone para evitar referenciar duas vezes a mesma variavel

                    $resultPAC =  clone $calculoFrete->calculate();

                    //cria uma pesquisa para SEDEX
                    $calculoFrete->setCodigoServico(Data::SEDEX);

                    $resultSedex = clone $calculoFrete->calculate();

                    //dd($result['cServico']);

                    // return Prod_CarrinhoController::showCheckout($result);

                    /**
                     * Transforma o código recebido no nome do serviço
                     *
                     * 04510 -> PAC
                     * 04014 -> SEDEX
                     *
                     */

                    if(($resultPAC['cServico']['Codigo']) == "04510"){
                        $tipoPac = "PAC";
                    }

                    if(($resultSedex['cServico']['Codigo']) == "04014"){
                        $tipoSedex = "SEDEX";
                    }


                    /**
                     * Envia em resposta apenas os dados úteis
                     * -Nome do Serviço
                     * -Valor
                     * -Prazo
                     *
                     */
                    return response()->json([
                        'tipoPac' => $tipoPac,
                        'valorPac' => $resultPAC['cServico']['Valor'],
                        'prazoPac' => $resultPAC['cServico']['PrazoEntrega'],

                        'tipoSedex' => $tipoSedex,
                        'valorSedex' => $resultSedex['cServico']['Valor'],
                        'prazoSedex' => $resultSedex['cServico']['PrazoEntrega']
                        // 'data' => $request
                    ]);

                } catch (FreteException $e) {
                    echo $e->getMessage();
                    echo $e->getCode();
                }

        } catch (\Throwable $th) {
            echo $th->getMessage();

        }

    }

}
