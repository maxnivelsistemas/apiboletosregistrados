<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\HttpClient\Interfaces;

/**
 *
 * @author Antonio
 */
interface ICoreCliente {

    public function addHeader($nome, $valor);

    public function postJson($endpoint, array $body = null);

    public function postParam($endpoint, array $param = null);

    public function putJson($endpoint, array $body = null);

    public function patchJson($endpoint, array $body = null);

    public function delete($endpoint);

    public function get($endpoint, array $queryString = null);

    public function getResposta($assoc = false);
}
