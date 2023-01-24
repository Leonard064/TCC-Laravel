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
    public function calculoFrete($id){

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
                    ->setPeso(0.5);

                try {
                    $result = $calculoFrete->calculate();

                    //dd($result['cServico']);

                    // return Prod_CarrinhoController::showCheckout($result);

                    if(($tipo =  $result['cServico']['Codigo']) == "04510"){
                        $tipo = "PAC";
                    }else if(($tipo =  $result['cServico']['Codigo']) == "04014"){
                        $tipo = "SEDEX";
                    }

                    return response()->json([
                        'tipo' => $tipo,
                        'valor' => $result['cServico']['Valor'],
                        'prazo' => $result['cServico']['PrazoEntrega']
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
