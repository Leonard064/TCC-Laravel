<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;

class FreteController extends Controller
{

    //API de retorno de fretes
    public function calculoFrete(){

        $teste = new PrecoPrazo();
        $teste->setCodigoServico(Data::SEDEX)
                ->setCepOrigem('07500000')
                ->setCepDestino('21030001')
                ->setComprimento(30)
                ->setAltura(30)
                ->setLargura(30)
                ->setDiametro(30)
                ->setPeso(0.5);

            try {
                $result = $teste->calculate();

                //dd($result['cServico']['Valor'], $result['cServico']['PrazoEntrega']);

            } catch (FreteException $e) {
                echo $e->getMessage();
                echo $e->getCode();
            }

        return response()->json([
            'valor' => $result['cServico']['Valor'],
            'dias' =>  $result['cServico']['PrazoEntrega'],
        ]);

    }

    public function teste(){

        $teste = new PrecoPrazo();
        $teste->setCodigoServico(Data::SEDEX)
                ->setCepOrigem('07500000')
                ->setCepDestino('21030001')
                ->setComprimento(30)
                ->setAltura(30)
                ->setLargura(30)
                ->setDiametro(30)
                ->setPeso(0.5);

            try {
                $result = $teste->calculate();

                dd($result['cServico']['Valor'], $result['cServico']['PrazoEntrega']);

            } catch (FreteException $e) {
                echo $e->getMessage();
                echo $e->getCode();
            }

    }
}
