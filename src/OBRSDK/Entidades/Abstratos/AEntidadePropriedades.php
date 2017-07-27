<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades\Abstratos;

/**
 * Description of ABancos
 *
 * @author Antonio
 */
abstract class AEntidadePropriedades {

    public function getAtributes($entidade = null) {
        $atributos = get_object_vars($entidade == null ? $this : $entidade);

        $atributosPreenchidos = [];
        foreach ($atributos as $atributoNome => $valor) {
            if ($valor != null) {
                $atributoValor = $valor;
                if (is_array($atributoValor)) {
                    $atributoValor = $this->percorrerArrayAtributo($atributoValor);
                } else if (is_object($atributoValor)) {
                    $atributoValor = $this->getAtributes($atributoValor);
                }

                $atributosPreenchidos[$atributoNome] = $atributoValor;
            }
        }

        return $atributosPreenchidos;
    }

    public function setAtributos(array $atributos) {
        foreach ($atributos as $atributoNome => $valor) {
            if (property_exists($this, $atributoNome)) {
                $this->$atributoNome = $valor;
            }
        }
    }

    private function percorrerArrayAtributo($valor) {
        $atributoValor = [];

        foreach ($valor as $v) {
            if (is_object($v)) {
                $atributoValor[] = $this->getAtributes($v);
            } else {
                $atributoValor[] = $v;
            }
        }

        return $atributoValor;
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

}
