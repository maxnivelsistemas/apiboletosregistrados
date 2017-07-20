<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Exceptions;

/**
 * Description of ConfiguracaoInvalida
 *
 * @author Antonio
 */
class ConfiguracaoInvalida extends \Exception {

    public function __construct($message) {
        parent::__construct($message);
    }

}
