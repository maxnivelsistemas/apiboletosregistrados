<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades\Abstratos;

/**
 * Description of AEntidadePreenchimento
 *
 * @author Antonio
 */
abstract class AEntidadePreenchimento {

    public function setAtributos(array $atributos) {
        foreach ($atributos as $atributoNome => $valor) {
            if (property_exists($this, $atributoNome)) {
                $this->preencherPropriedade($atributoNome, $valor);
            }
        }
    }

    private function preencherPropriedade($propriedade, $valor) {
        if (is_object($this->$propriedade) || is_array($this->$propriedade)) {
            $this->$propriedade = $this->tratarValorPropriedade($propriedade, $valor);
            return;
        }

        $this->$propriedade = $valor;
    }

    private function tratarValorPropriedade($propriedade, $valor) {
        if (is_array($this->$propriedade)) {
            $return = [];
            foreach ($valor as $vv) {
                $return[] = $this->getObject($propriedade, $vv);
            }
            return $return;
        } else {
            return $this->getObject($propriedade, $valor);
        }
    }

    private function getObject($objectNome, $valor) {
        $namespaceClass = '\OBRSDK\Entidades\\' . $this->underscoreParaPascalCase($objectNome);

        if (!class_exists($namespaceClass)) {
            return;
        }

        $instance = new $namespaceClass;
        $instance->setAtributos($valor);
        return $instance;
    }

    protected function pascalCaseParaUnderscore($texto) {
        return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $texto)), '_');
    }

    protected function underscoreParaPascalCase($texto) {
        return trim(lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $texto)))));
    }

}
