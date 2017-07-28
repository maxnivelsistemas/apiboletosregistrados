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
abstract class AEntidadePropriedades extends AEntidadePreenchimento {

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

    /// ====
    /// MAGIC METHODS
    /// ====

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function __call($metodo, $param) {
        if (strtolower(substr($metodo, 0, 3)) == "get") {
            $get = substr($metodo, 3);
            $property = $this->camelCaseParaUnserScore($get);

            return $this->$property;
        }
    }

}
