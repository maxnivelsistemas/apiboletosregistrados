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
    public function autenticarComAutorizacao($code = null) {
        $error = filter_input(INPUT_GET, 'error');
        if ($error != null && $error != '') {
            throw new \OBRSDK\Exceptions\AutorizationException($error, filter_input(INPUT_GET, 'error_description'));
        }

        $authorizationCode = $code === null ? filter_input(INPUT_GET, 'code') : $code;
        $this->oauth([
            'grant_type' => 'authorization_code',
            'code' => $authorizationCode
        ]);

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
            $param = array_merge(
                    $config, [
                'client_id' => $this->getInstancia()->getAppId(),
                'client_secret' => $this->getInstancia()->getAppSecret()
                    ]
            );

            $response = $this->apiCliente->postParam('auth/token', $param)->getRespostaArray();

            if (!isset($response['refresh_token'])) {
                $response['refresh_token'] = null;
            }
            $response['data_token'] = time();

            $entidadeAccessToken = new \OBRSDK\Entidades\AccessToken();
            $entidadeAccessToken->setAtributos($response);

            $this->getInstancia()->setObjAccessToken($entidadeAccessToken);
        } catch (\OBRSDK\Exceptions\RespostaException $ex) {
            if (isset($ex->getError()->OAuth2->erro_description)) {
                throw new \OBRSDK\Exceptions\AutenticacaoException($ex);
            } else {
                throw $ex;
            }
        }
    }

}
