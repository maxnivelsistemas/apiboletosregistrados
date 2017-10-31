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

    /**
     *
     * @var @var \OBRSDK\Entidades\Boletos[]
     */
    protected $boletos;

    public function getRetornoId() {
        return $this->retorno_id;
    }

    /**
     * 
     * @return \OBRSDK\Entidades\Boletos[]
     */
    public function getBoletos() {
        return $this->boletos;
    }

}
