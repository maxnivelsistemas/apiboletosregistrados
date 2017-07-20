<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Exceptions;

/**
 * Description of AutorizationException
 *
 * @author Antonio
 */
class AutorizationException extends \Exception {

    private $error;
    private $description;

    public function __construct($error, $description) {
        parent::__construct($description);
        $this->error = $error;
        $this->description = $description;
    }

    public function getErro() {
        return $this->error;
    }

    public function getDescricao() {
        return $this->description;
    }

}
