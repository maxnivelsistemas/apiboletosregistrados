<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\HttpClient\Nucleo;

/**
 * Description of ApiCliente
 *
 * @author Antonio
 */
class ApiCliente extends Instancia implements \OBRSDK\HttpClient\Interfaces\ICoreCliente {

    /**
     * Adiciona o cabeçalho de autorizacao com o token da instancia
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function addAuthorization() {
        $this->addHeader('Authorization', 'Bearer ' . $this->getInstancia()->getObjAccessToken()->getAccessToken());
        return $this;
    }

    /**
     * Adiciona um cabeçalho opcional
     * 
     * @param string $nome
     * @param string $valor
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function addHeader($nome, $valor) {
        HttpCliente::getInstance()->addHeader($nome, $valor);
        return $this;
    }

    /**
     * Faz requisição get no endpoint com os parametros via querystring
     * 
     * @param string $endpoint
     * @param array $queryString
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function get($endpoint, array $queryString = null) {
        HttpCliente::getInstance()->get($endpoint, $queryString);
        return $this;
    }

    /**
     * Faz requisição post no endpoint com corpo json opcional
     * 
     * @param string $endpoint
     * @param array $body
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function postJson($endpoint, array $body = null) {
        HttpCliente::getInstance()->postJson($endpoint, $body);
        return $this;
    }

    /**
     * Faz requisição post no endpoint com parametros application/x-www-form-urlencoded
     * opcional
     * 
     * @param string $endpoint
     * @param array $param
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function postParam($endpoint, array $param = null) {
        HttpCliente::getInstance()->postParam($endpoint, $param);
        return $this;
    }

    /**
     * Pega a resposta da requisição feita
     * 
     * @param bool $assoc
     * @return array|object
     */
    public function getResposta($assoc = false) {
        return HttpCliente::getInstance()->getResposta($assoc);
    }

    /**
     * Envia requisição delete no endpoint especificado
     * 
     * @param string $endpoint
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function delete($endpoint) {
        HttpCliente::getInstance()->delete($endpoint);
        return $this;
    }

    /**
     * Envia a requisição patch no endpoint especificado podendo passar 
     * um corpo json
     * 
     * @param string $endpoint
     * @param array $body
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function patchJson($endpoint, array $body = null) {
        HttpCliente::getInstance()->patchJson($endpoint, $body);
        return $this;
    }

    /**
     * Envia a requisição put no endpoint especificado podendo passar 
     * um corpo json
     * 
     * @param string $endpoint
     * @param array $body
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function putJson($endpoint, array $body = null) {
        HttpCliente::getInstance()->putJson($endpoint, $body);
        return $this;
    }

}
