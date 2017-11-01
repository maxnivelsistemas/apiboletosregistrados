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
            return;
        }
    }

    protected function debugDadosRecebido($uri, $type, $dados, $headers, $statusCode) {
        try {
            if (!self::$debugModeStatus) {
                return;
            }

            $json_decode = [];
            $this->filtrarDados($dados, $json_decode);

            self::$debugObject->dadosRecebido($uri, $type, $json_decode, $headers == null ? [] : $headers, $statusCode);
        } catch (\Exception $ex) {
            return;
        }
    }

    private function filtrarDados(&$dados, &$json_decode) {
        if (is_null($dados)) {
            $dados = '{}';
        }

        $json_decode = json_decode($dados, true);
        if ($json_decode == null) {
            $json_decode = ['json_decode_falha' => $dados];
        }
    }

}
