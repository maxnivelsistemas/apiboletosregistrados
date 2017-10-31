<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades;

/**
 * Description of BancoDoBrasil
 *
 * @author Antonio
 */
class BancoDoBrasil extends Abstratos\ABanco {

    ///
    /// ATRIBUTOS OBRIGATORIOS
    ///
    public $convenio;
    public $carteira;
    public $carteira_variacao;
    public $carteira_modalidade;
    
    public function getConvenio() {
        return $this->convenio;
    }

    public function getCarteira() {
        return $this->carteira;
    }

    public function getCarteira_variacao() {
        return $this->carteira_variacao;
    }

    public function getCarteiraModalidade() {
        return $this->carteira_modalidade;
    }



}
