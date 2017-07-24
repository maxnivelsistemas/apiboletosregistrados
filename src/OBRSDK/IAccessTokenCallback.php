<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK;

/**
 * Essa interface provide a estrutura para classe que deve receber um callback 
 * quando o access token da api for atualizado
 * 
 * @author Antonio
 */
interface IAccessTokenCallback {

    public function novoAccessToken(Entidades\AccessToken $accessToken);
}
