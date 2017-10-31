<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades;

/**
 * Description of Beneficiario
 *
 * @author Antonio
 */
class Beneficiario extends Abstratos\AEntidadePropriedades {

    ///
    /// ATRIBUTOS OBRIGATORIOS
    ///
    public $nosso_numero_inicial;
    public $agencia;
    public $agencia_digito;
    public $conta;
    public $conta_digito;
    public $nome_beneficiario;
    public $documento_beneficiario;
    public $cep_beneficiario;
    public $uf_beneficiario;
    public $cidade_beneficiario;
    public $bairro_beneficiario;
    public $endereco_beneficiario;
    public $endereco_numero_beneficiario;

    public function getNossoNumeroInicial() {
        return $this->nosso_numero_inicial;
    }

    public function getAgencia() {
        return $this->agencia;
    }

    public function getAgenciaDigito() {
        return $this->agencia_digito;
    }

    public function getConta() {
        return $this->conta;
    }

    public function getContaDigito() {
        return $this->conta_digito;
    }

    public function getNomeBeneficiario() {
        return $this->nome_beneficiario;
    }

    public function getDocumentoBeneficiario() {
        return $this->documento_beneficiario;
    }

    public function getCepBeneficiario() {
        return $this->cep_beneficiario;
    }

    public function getUfBeneficiario() {
        return $this->uf_beneficiario;
    }

    public function getCidadeBeneficiario() {
        return $this->cidade_beneficiario;
    }

    public function getBairroBeneficiario() {
        return $this->bairro_beneficiario;
    }

    public function getEnderecoBeneficiario() {
        return $this->endereco_beneficiario;
    }

    public function getEnderecoNumeroBeneficiario() {
        return $this->endereco_numero_beneficiario;
    }

}
