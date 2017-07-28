<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK;

/**
 * Description of DevMode
 *
 * @author Antonio
 */
abstract class DebugMode {

    protected static $debugModeStatus = false;

    /**
     *
     * @var \OBRSDK\IDebugModeCallback
     */
    protected static $debugObject;

    public static function setDebugObject(\OBRSDK\IDebugModeCallback $callback) {
        self::$debugModeStatus = true;
        self::$debugObject = $callback;
    }

    protected function debugDadosEnviado($uri, $type, $dados) {
        try {
            if (self::$debugModeStatus) {
                self::$debugObject->dadosEnviado($uri, $type, $dados);
            }
        } catch (\Exception $ex) {
            
        }
    }

    protected function debugDadosRecebido($uri, $type, $dados, $headers, $statusCode) {
        try {
            if (self::$debugModeStatus) {
                if ($dados == null) {
                    $dados = array();
                }

                if ($headers == null) {
                    $headers = array();
                }

                self::$debugObject->dadosRecebido($uri, $type, json_decode($dados, true), $headers, $statusCode);
            }
        } catch (\Exception $ex) {
            
        }
    }

}
