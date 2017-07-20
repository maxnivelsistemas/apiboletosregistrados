<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK;

/**
 * Description of Autenticacao
 *
 * @author Antonio
 */
class Autenticacao {

    private $oauthCliente;

    public function __construct(ObjetoBoletosRegistrados $instancia) {
        $this->oauthCliente = new HttpClient\OAuth2Cliente($instancia);
    }

    /**
     * Pega a entidade do accesstoken gerado na autenticacao
     * 
     * @return \OBRSDK\Entidades\AccessToken
     */
    public function getObjAccessToken() {
        return $this->oauthCliente->getInstancia()->getObjAccessToken();
    }

    /**
     * Faz autenticacao com codigo de autorizacao recebido via callback 
     * pela autorizacao de um usuário
     * 
     * Nesse modelo de autenticacao, você estara consumindo e gerando dados na 
     * api em nome do usuário que autorizou o acesso de acordo com as permissões 
     * requisitadas
     * 
     * @param string $code
     * @return mixed estado retornado no callback 
     */
    public function porAutorizacaoUsuario($code = null) {
        return $this->oauthCliente->autenticarComAutorizacao($code);
    }

    /**
     * Faz autenticacao com as credenciais appId e appSecret
     * Nesse modelo de autenticacao, a api estara utilizando o proprio acesso
     * do appId e appSecret para consumir e gerar dados
     */
    public function porCredenciais() {
        $this->oauthCliente->autenticarComCredenciais();
    }

    /**
     * Faz autenticacao atraves de um refresh token, os refresh token são recebido 
     * quando é feito uma autenticacao via autorizacao, apos a autenticacao da 
     * autorizacao expirar, você pode refazer a autenticacao com aquela autorizacao 
     * utilizando o refresh token da mesma
     * 
     * @param string $refreshToken
     */
    public function porRefreshToken($refreshToken) {
        $this->oauthCliente->autenticarComRefreshToken($refreshToken);
    }

}
