<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\HttpClient;

/**
 * Description of BoletosCliente
 *
 * @author Antonio
 */
class BoletosCliente extends Nucleo\ApiCliente {

    /**
     * 
     * @param \OBRSDK\Entidades\BancoDoBrasil $banco
     * @param \OBRSDK\Entidades\Beneficiario $beneficiario
     * @param \OBRSDK\Entidades\Boletos[] $boletos
     * @return \OBRSDK\Entidades\Boletos[]
     * @throws \OBRSDK\Exceptions\PreenchimentoIncorreto
     */
    public function gerarBancoDoBrasil(
    \OBRSDK\Entidades\BancoDoBrasil $banco, \OBRSDK\Entidades\Beneficiario $beneficiario, $boletos) {
        if (!is_array($boletos) && !($boletos instanceof \OBRSDK\Entidades\Boletos)) {
            throw new \OBRSDK\Exceptions\PreenchimentoIncorreto("Boletos precisam ser um array de entidade Boletos");
        }

        $boletos = !is_array($boletos) ? array($boletos) : $boletos;

        $banco_dados = $banco->getAtributes();
        $beneficiario_dados = $beneficiario->getAtributes();
        $boletos_dados = [];

        foreach ($boletos as $boleto) {
            if (!($boleto instanceof \OBRSDK\Entidades\Boletos)) {
                throw new \OBRSDK\Exceptions\PreenchimentoIncorreto("Boletos precisam ser um array de entidade Boletos");
            }
            $boletos_dados[] = $boleto->getAtributes();
        }

        $param = [
            'banco_do_brasil' => $banco_dados,
            'beneficiario' => $beneficiario_dados,
            'boletos' => $boletos_dados
        ];


        $response = $this->addAuthorization()
                ->postJson('boletos', $param)
                ->getResposta(true);

        for ($i = 0; $i < count($response['boletos']); $i++) {
            // preenche o objeto de boletos recebido
            // com as informacoes recebida da api
            $boletos[$i]->setAtributos($response['boletos'][$i]);
        }

        return $boletos;
    }

    /**
     * 
     * @param \OBRSDK\Entidades\Beneficiario $beneficiario
     * @param array $query_string_opcional
     * @return \OBRSDK\Entidades\Boletos[]
     */
    public function listarBoletos(\OBRSDK\Entidades\Beneficiario $beneficiario, array $query_string_opcional) {
        $query_string = array_merge($beneficiario->getAtributes(), $query_string_opcional);

        $response = $this->addAuthorization()
                ->get('boletos', $query_string)
                ->getResposta(true);

        $boletos = [];
        foreach ($response['boletos'] as $boleto) {
            $boletoEntidade = new \OBRSDK\Entidades\Boletos();
            $boletoEntidade->setAtributos($boleto);
            $boletos[] = $boletoEntidade;
        }

        return $boletos;
    }

}
