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
        'banco_do_brasil' => 'BancoDoBrasil'
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

}
