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
class ApiCliente implements \OBRSDK\HttpClient\Interfaces\ICoreCliente {

    private $instancia;

    public function __construct(\OBRSDK\ObjetoBoletosRegistrados $instancia) {
        $this->instancia = $instancia;
    }

    /**
     * Adiciona o cabeçalho de autorizacao com o token da instancia
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function addAuthorization() {
        $this->instancia->verificarAccessToken();
        $this->addHeader('Authorization', 'Bearer ' . $this->instancia->getObjAccessToken()->getAccessToken());
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

        public function postRaw($endpoint,$raw){

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => HttpCliente::$BASE_URL.'v1/'.$endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $raw,
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$this->instancia->getObjAccessToken()->getAccessToken(),
                "cache-control: no-cache",
                "content-type: text/plain"
            ),
        ));

        $response = curl_exec($curl);
       
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            throw new \Exception($err);
        } else {
            return json_decode($response);
        }
    }

    /**
     * Pega a resposta da requisição feita
     * @return array
     */
    public function getRespostaArray() {
        return HttpCliente::getInstance()->getResposta(true);
    }

    /**
     * Pega a resposta da requisição feita
     * @return object
     */
    public function getRespostaObject() {
        return HttpCliente::getInstance()->getResposta(false);
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

    /**
     * Faz upload de um arquivo para a API
     * 
     * @param string $endpoint
     * @param string $arquivo
     * @return \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    public function enviarArquivo($endpoint, $arquivo) {
        HttpCliente::getInstance()->enviarArquivo($endpoint, $arquivo);
        return $this;
    }

}
