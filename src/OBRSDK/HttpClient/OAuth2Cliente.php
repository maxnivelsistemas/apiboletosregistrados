<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\HttpClient;

/**
 * Description of OAuth2Cliente
 *
 * @author Antonio
 */
class OAuth2Cliente extends Nucleo\Instancia {

    /**
     * Testa se o atual accesstoken esta autenticando com sucesso na api
     */
    public function testarAutenticacao() {
        $this->apiCliente->addAuthorization()->get('auth/ping')->getRespostaObject();
    }

    /**
     * Faz autenticacao na API com as suas credenciais de 'appId' e 'appSecret'
     * Neste caso você consegue acessar seus dados
     * 
     * @throws \OBRSDK\Exceptions\RespostaException
     * @throws \OBRSDK\Exceptions\AutenticacaoException
     */
    public function autenticarComCredenciais() {
        $this->oauth([
            'grant_type' => 'client_credentials',
            'scope' => '*'
        ]);
    }

    /**
     * Faz autenticacao na API em nome de outro usuário utilizando um codigo de 
     * autorização que esse usuário permite em ser utilizado por você
     * 
     * @param string $code
     * @return mixed
     * @throws OBRSDK\Exceptions\AutorizationException
     * @throws \OBRSDK\Exceptions\RespostaException
     */
    public function autenticarComAutorizacao($code = null, array $config = []) {
        $error = filter_input(INPUT_GET, 'error');
        if ($error != null && $error != '') {
            throw new \OBRSDK\Exceptions\AutorizationException($error, filter_input(INPUT_GET, 'error_description'));
        }
        $this->oauth(array_merge($config, [
            'grant_type' => 'authorization_code',
            'code' => $code === null ? filter_input(INPUT_GET, 'code') : $code
        ]));
        return filter_input(INPUT_GET, 'state');
    }

    /**
     * Se um access_token com permissoes de um usuário foi expirado e você tiver 
     * um reflesh token do mesmo, você pode resolicitar uma nova autenticacao
     * utilizando o reflesh token
     * 
     * @param string $refreshToken
     * @throws \OBRSDK\Exceptions\RespostaException
     * @throws \OBRSDK\Exceptions\AutenticacaoException
     * @return \OBRSDK\ObjetoBoletosRegistrados
     */
    public function autenticarComRefreshToken($refreshToken) {
        $this->oauth([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken
        ]);
    }

    /**
     * 
     * @param array $config
     * @return \OBRSDK\ObjetoBoletosRegistrados
     * @throws \OBRSDK\Exceptions\AutenticacaoException
     * @throws \OBRSDK\Exceptions\RespostaException
     */
    private function oauth(array $config) {
        try {
            $resposta = $this->apiCliente
                    ->postParam('auth/token', $this->getParametroOauthToken($config))
                    ->getRespostaArray();

            $this->getInstancia()->setObjAccessToken($this->entidadeAccessToken($resposta));
        } catch (\OBRSDK\Exceptions\RespostaException $ex) {
            if (isset($ex->getError()->OAuth2->erro_description)) {
                throw new \OBRSDK\Exceptions\AutenticacaoException($ex);
            } else {
                throw $ex;
            }
        }
    }

    /**
     * 
     * @param array $config
     * @return array
     */
    private function getParametroOauthToken(array $config) {
        return array_merge($config, [
            'client_id' => $this->getInstancia()->getAppId(),
            'client_secret' => $this->getInstancia()->getAppSecret()
        ]);
    }

    /**
     * 
     * @param array $respostaOauth
     * @return \OBRSDK\Entidades\AccessToken
     */
    private function entidadeAccessToken(array $respostaOauth) {
        if (!isset($respostaOauth['refresh_token'])) {
            $respostaOauth['refresh_token'] = null;
        }

        $respostaOauth['data_token'] = time();

        $entidadeAccessToken = new \OBRSDK\Entidades\AccessToken();
        $entidadeAccessToken->setAtributos($respostaOauth);

        return $entidadeAccessToken;
    }

}
