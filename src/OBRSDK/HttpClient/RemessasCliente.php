<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\HttpClient;

/**
 * Description of RemessasCliente
 *
 * @author Antonio
 */
class RemessasCliente extends Nucleo\Instancia {

    /**
     * 
     * @param \OBRSDK\Entidades\Remessas $remessas
     * @return \OBRSDK\Entidades\Remessas[]
     */
    public function gerarRemessa(\OBRSDK\Entidades\Remessas $remessas) {
        $remessas_dados = $this->organizarDadosRemessa($remessas->getAtributes());

        $this->apiCliente->addAuthorization()
                ->postJson('remessas', $remessas_dados);

        return $this->getListaEntidade('remessas', new \OBRSDK\Entidades\Remessas());
    }

    /**
     * @param string $remessa_id
     * @return \OBRSDK\Entidades\Remessas
     */
    public function getRemessaPorId($remessa_id) {
        $resposta = $this->apiCliente->addAuthorization()
                        ->get('remessas/' . $remessa_id)->getRespostaArray();

        $remessa_resposta = new \OBRSDK\Entidades\Remessas();
        $remessa_resposta->setAtributos($resposta);

        return $remessa_resposta;
    }

    /**
     * 
     * @param array $remessas_dados
     * @return array
     */
    private function organizarDadosRemessa(array $remessas_dados) {
        if (!isset($remessas_dados['boletos']) || !is_array($remessas_dados['boletos'])) {
            $remessas_dados['boletos'] = [];
        }

        $boletos = [];
        foreach ($remessas_dados['boletos'] as $boleto) {
            $boletos[] = [
                "boleto_id" => $boleto['boleto_id']
            ];
        }
        // remove dados anterior
        unset($remessas_dados['boletos']);
        // seta com dados atualizado
        $remessas_dados['boletos'] = $boletos;

        return $remessas_dados;
    }

}
