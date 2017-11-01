<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Exceptions;

/**
 * Description of AutenticacaoException
 *
 * @author Antonio
 */
class AutenticacaoException extends \Exception {

    /**
     *
     * @var RespostaException 
     */
    private $respostaException;

    public function __construct(RespostaException $ex) {
        $this->respostaException = $ex;
    }

    public function getTitulo() {
        $this->respostaException->getError()->OAuth2->error;
    }

    public function getErro() {
        $this->respostaException->getError()->OAuth2->error_description;
    }

}
