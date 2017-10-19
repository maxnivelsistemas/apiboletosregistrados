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
    /**
     *
     * @var @var \OBRSDK\Entidades\Boletos[]
     */
    protected $boletos;

    /**
     * 
     * @return \OBRSDK\Entidades\Boletos[]
     */
    public function getBoletos() {
        return $this->boletos;
    }

}
