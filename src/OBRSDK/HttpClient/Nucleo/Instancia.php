<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\HttpClient\Nucleo;

/**
 * Description of Instancia
 *
 * @author Antonio
 */
abstract class Instancia {

    private $instancia;

    public function __construct(\OBRSDK\ObjetoBoletosRegistrados $instancia) {
        $this->instancia = $instancia;
    }

    /**
     * 
     * @return \OBRSDK\ObjetoBoletosRegistrados
     */
    public function getInstancia() {
        return $this->instancia;
    }

}
