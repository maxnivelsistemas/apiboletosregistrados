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
        $resposta = $this->apiCliente->addAuthorization()
                ->postJson('boletos', $this->getBodyGerarBoletos($banco, $beneficiario))
                ->getRespostaArray();

        $quantidadeBoletos = !isset($resposta['boletos']) ? 0 : count($resposta['boletos']);

        $boletos = $this->boletosParaGerar;
        for ($i = 0; $i < $quantidadeBoletos; $i++) {
            $boletos[$i]->setAtributos($resposta['boletos'][$i]);
        }
        $this->boletosParaGerar = [];

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

        $this->apiCliente->addAuthorization()
                ->get('boletos', $query_string);

        return $this->getListaEntidade('boletos', new \OBRSDK\Entidades\Boletos());
    }

    /**
     * 
     * @param \OBRSDK\HttpClient\OBRSDK\Entidades\Abstratos\ABanco $banco
     * @param \OBRSDK\Entidades\Beneficiario $beneficiario
     * @return array
     */
    private function getBodyGerarBoletos(\OBRSDK\Entidades\Abstratos\ABanco $banco, \OBRSDK\Entidades\Beneficiario $beneficiario) {
        $boletos_dados = [];
        foreach ($this->boletosParaGerar as $boleto) {
            $boletos_dados[] = $boleto->getAtributes();
        }

        return [
            $banco->getNomeBancoJson() => $banco->getAtributes(),
            "beneficiario" => $beneficiario->getAtributes(),
            "boletos" => $boletos_dados
        ];
    }

}
