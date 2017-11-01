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
class BoletosCliente extends Nucleo\Instancia {

    /**
     *
     * @var \OBRSDK\Entidades\Boletos[]
     */
    private $boletosParaGerar = [];

    /**
     * Adiciona um boleto para ser gerado
     * 
     * @param \OBRSDK\Entidades\Boletos $boleto
     */
    public function addBoletoParaGerar(\OBRSDK\Entidades\Boletos $boleto) {
        $this->boletosParaGerar[] = $boleto;
    }

    /**
     * Gera os boletos adicionado na lista
     * 
     * @param \OBRSDK\Entidades\Abstratos\ABanco $banco
     * @param \OBRSDK\Entidades\Beneficiario $beneficiario
     * @param \OBRSDK\Entidades\Boletos[] $boletos
     * @return \OBRSDK\Entidades\Boletos[]
     * @throws \OBRSDK\Exceptions\PreenchimentoIncorreto
     */
    public function gerarBoletos(\OBRSDK\Entidades\Abstratos\ABanco $banco, \OBRSDK\Entidades\Beneficiario $beneficiario) {
        $boletos = $this->boletosParaGerar;
        $boletos_dados = [];
        foreach ($boletos as $boleto) {
            $boletos_dados[] = $boleto->getAtributes();
        }

        $response = $this->apiCliente->addAuthorization()
                ->postJson('boletos', [
                    $banco->getNomeBancoJson() => $banco->getAtributes(),
                    "beneficiario" => $beneficiario->getAtributes(),
                    "boletos" => $boletos_dados
                ])
                ->getRespostaArray();

        $this->boletosParaGerar = [];

        $quantidadeBoletos = 0;
        if (isset($response['boleots'])) {
            $quantidadeBoletos = is_array($response['boletos']) ? count($response['boletos']) : 1;
        }

        for ($i = 0; $i < $quantidadeBoletos; $i++) {
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

        $response = $this->apiCliente->addAuthorization()
                ->get('boletos', $query_string)
                ->getRespostaArray();

        $boletos = [];
        foreach ($response['boletos'] as $boleto) {
            $boletoEntidade = new \OBRSDK\Entidades\Boletos();
            $boletoEntidade->setAtributos($boleto);
            $boletos[] = $boletoEntidade;
        }

        return $boletos;
    }

}
