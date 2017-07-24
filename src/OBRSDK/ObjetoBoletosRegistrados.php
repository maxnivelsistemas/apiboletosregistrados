<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK;

/**
 * Description of Boletos
 *
 * @author Antonio
 */
class ObjetoBoletosRegistrados {

    private $appId;
    private $appSecret;
    private $accessToken = null;
    private $autenticacao;

    /**
     *
     * @var IAccessTokenCallback
     */
    private $accessTokenUpdateCallback;

    public function __construct(array $config, \OBRSDK\Entidades\AccessToken $objAccessToken = null) {
        if (!isset($config['appId']) || !isset($config['appSecret'])) {
            throw new Exceptions\ConfiguracaoInvalida("É necessário passar um 'appId' e um 'appSecret' nas configurações inicial");
        }

        $this->appId = $config['appId'];
        $this->appSecret = $config['appSecret'];
        if ($objAccessToken != null) {
            $this->accessToken = $objAccessToken;
        }
        $this->autenticacao = new Autenticacao($this);
    }

    public function getAppId() {
        return $this->appId;
    }

    public function getAppSecret() {
        return $this->appSecret;
    }

    /**
     * Pega o objeto de realizar autenticacao
     * 
     * @return \OBRSDK\Autenticacao
     */
    public function Autenticar() {
        return $this->autenticacao;
    }

    /**
     * Pega o objeto de autenticacao AccessToken que contem 
     * informações do token de autenticacao atual como data que expire
     * refresh tokens, escopos utilizado e o proprio access_token
     * 
     * @return \OBRSDK\Entidades\AccessToken
     */
    public function getObjAccessToken() {
        return $this->accessToken;
    }

    /**
     * Seta o objeto AccessToken
     * @param \OBRSDK\Entidades\AccessToken $autenticacao
     */
    public function setObjAccessToken(Entidades\AccessToken $autenticacao) {
        $this->accessToken = $autenticacao;
        if ($this->accessTokenUpdateCallback != null) {
            $this->accessTokenUpdateCallback->novoAccessToken($this->accessToken);
        }
    }

    /**
     * Seta um objeto do tipo IAccessTokenCallback para receber sempre uma chamada 
     *  quando o token de acesso for atualizado pelo SDK
     * 
     * O Objeto do token atualizado é recebido na funcao 'novoAccessToken'
     * 
     * @param \OBRSDK\IAccessTokenCallback $accessTokenCallback
     */
    public function setAccessTokenUpdateCallback(IAccessTokenCallback $accessTokenCallback) {
        $this->accessTokenUpdateCallback = $accessTokenCallback;
    }

    /**
     * Verifica se o access token esta expirado, se tiver tenta pegar um novo 
     * access token via refresh token se o mesmo existir, se não existir refresh 
     * token, tenta autenticar por credenciais
     */
    public function verificarAccessToken() {
        if ($this->accessToken->getDataToken() + $this->accessToken->getExpireIn() - 10 <= time()) {
            if ($this->accessToken->getRefreshToken() != null && strlen($this->accessToken->getRefreshToken()) > 0) {
                $this->Autenticar()->porRefreshToken($this->accessToken->getRefreshToken());
            } else {
                $this->Autenticar()->porCredenciais();
            }
        }
    }

}
