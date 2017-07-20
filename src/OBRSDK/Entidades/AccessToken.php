<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades;

/**
 * Description of AccessToken
 *
 * @author Antonio
 */
class AccessToken extends Abstratos\AEntidadePropriedades {

    protected $access_token;
    protected $expire_in;
    protected $scope;
    protected $refresh_token;
    protected $data_token;

    /**
     * Retorna o access_token
     * @return string
     */
    public function getAccessToken() {
        return $this->access_token;
    }

    /**
     * Retorna em segundos quanto tempo de validade tem esse token
     * @return int
     */
    public function getExpireIn() {
        return $this->expire_in;
    }

    /**
     * Retorna o escopo de permissão desse access_token
     * 
     * @return string
     */
    public function getEscopo() {
        return $this->scope;
    }

    /**
     * Retorna o refresh_token desse access_token para gerar um novo 
     * access_token com as mesmas permissões desde
     * 
     * @return string
     */
    public function getRefreshToken() {
        return $this->refresh_token;
    }

    /**
     * Retorna o unixtimestamp de quando esse token foi criado
     * 
     * @return int
     */
    public function getDataToken() {
        return $this->data_token;
    }

}
