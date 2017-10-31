<?php

namespace OBRSDK\Entidades;

/**
 * @author Antonio
 * @since 19/10/2017
 */
class Retornos extends \OBRSDK\Entidades\Abstratos\AEntidadePropriedades {

    ///
    /// atributos de resposta
    ///
    protected $retorno_id;
    protected $banco;
    protected $data_recebimento;

    /**
     *
     * @var @var \OBRSDK\Entidades\Boletos[]
     */
    protected $boletos;

    public function getRetornoId() {
        return $this->retorno_id;
    }

    /**
     * Banco gerador do arquivo de retorno
     * @return string
     */
    public function getBanco() {
        return $this->banco;
    }

    /**
     * Data em que a API recebeu o retorno
     * @return string
     */
    public function getDataRecebimento() {
        return $this->data_recebimento;
    }

    /**
     * 
     * @return \OBRSDK\Entidades\Boletos[]
     */
    public function getBoletos() {
        return $this->boletos;
    }

}
