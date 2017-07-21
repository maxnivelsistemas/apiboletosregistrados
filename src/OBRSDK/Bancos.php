<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK;

/**
 * Description of Bancos
 *
 * @author Antonio
 */
class Bancos {

    private static $bancos = array(
        'BancoDoBrasil'
    );

    /**
     * Retorna array com os bancos disponiveis na api
     * chave = nome no json
     * valor = nome da entidade
     * @return array
     */
    public static function getBancosDisponiveis() {
        return self::$bancos;
    }

    /**
     * Retorna a entidade do banco por nome se achar a entidade do mesmo
     * Exemplo: banco_do_brasil roterona a entidade \OBRSDK\Entidades\BancoDoBrasil
     * @param string $banco_nome
     * @return \OBRSDK\Entidades\Abstratos\ABanco
     * @throws \Exception
     */
    public static function getEntidadeBancoPorNome($banco_nome) {
        $bancoClass = '\OBRSDK\Entidades\\' . lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $banco_nome))));

        if (!class_exists($bancoClass)) {
            throw new \Exception("Não foi possivel encontrar o banco '" . $banco_nome . "'");
        }

        return new $bancoClass;
    }

}
