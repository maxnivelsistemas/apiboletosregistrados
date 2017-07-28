<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades\Abstratos;

/**
 * Description of ABanco
 *
 * @author Antonio
 */
abstract class ABanco extends AEntidadePropriedades {

    public function getNomeBancoJson() {
        $called = explode("\\", get_called_class());
        $className = end($called);
        return $this->camelCaseParaUnserScore($className);
    }

}
