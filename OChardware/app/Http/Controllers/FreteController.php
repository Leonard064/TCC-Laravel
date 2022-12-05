<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use EscapeWork\Frete\Correios\PrecoPrazo;
use EscapeWork\Frete\Correios\Data;
use EscapeWork\Frete\FreteException;

class FreteController extends Controller
{

    //API de retorno de fretes
    public function calculoFrete(Request $request){

        $teste = new PrecoPrazo();
        $teste->setCodigoServico([Data::SEDEX, Data::PAC])
                ->setCodigoEmpresa('08082650')
                ->setSenha('564321')
                ->setCepOrigem('07500000')
                ->setCepDestino('21030001')
                ->setComprimento(30)
                ->setAltura(30)
                ->setLargura(30)
                ->setDiametro(30)
                ->setPeso(0.5);

            try {
                $result = $teste->calculate();

                return response()->json([
                    'data' => $result['cServico']
                ]);

            } catch (FreteException $e) {
                echo $e->getMessage();
                echo $e->getCode();
            }

    }

}
