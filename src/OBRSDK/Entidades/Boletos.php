<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades;

/**
 * Description of Boletos
 *
 * @author Antonio
 */
class Boletos extends Abstratos\AEntidadePropriedades {

    ///
    /// ATRIBUTOS DE RESPOSTA
    ///
    protected $boleto_id;
    protected $linha_digitavel;
    protected $codigo_febraban;
    protected $link;

    /**
     *
     * @var Retorno 
     */
    protected $retorno;
    ///
    /// ATRIBUTOS OBRIGATORIOS
    ///
    public $nome_sacado;
    public $documento_sacado;
    public $endereco_sacado;
    public $bairro_sacado;
    public $cep_sacado;
    public $cidade_sacado;
    public $uf_sacado;
    public $data_vencimento;
    public $valor_documento;
    ///
    /// ATRIBUTOS OPCIONAIS
    ///
    public $data_multa;
    public $valor_desconto;
    public $valor_multa;
    public $valor_juros_diario;
    public $dias_pag_vencimento;
    public $numero_documento;
    public $sequencial;
    public $aceite;
    public $local_pagamento;

    public function __construct() {
        $this->retorno = new Retorno();
    }

    public function getBoletoId() {
        return $this->boleto_id;
    }

    public function getLinhaDigitavel() {
        return $this->linha_digitavel;
    }

    public function getCodigoFebraban() {
        return $this->codigo_febraban;
    }

    public function getLink() {
        return $this->link;
    }

    public function getNomeSacado() {
        return $this->nome_sacado;
    }

    public function getDocumentoSacado() {
        return $this->documento_sacado;
    }

    public function getEnderecoSacado() {
        return $this->endereco_sacado;
    }

    public function getBairroSacado() {
        return $this->bairro_sacado;
    }

    public function getCepSacado() {
        return $this->cep_sacado;
    }

    public function getCidadeSacado() {
        return $this->cidade_sacado;
    }

    public function getUfSacado() {
        return $this->uf_sacado;
    }

    public function getDataVencimento() {
        return $this->data_vencimento;
    }

    public function getValorDocumento() {
        return $this->valor_documento;
    }

    public function getDataMulta() {
        return $this->data_multa;
    }

    public function getValorDesconto() {
        return $this->valor_desconto;
    }

    public function getValorMulta() {
        return $this->valor_multa;
    }

    public function getValorJurosDiario() {
        return $this->valor_juros_diario;
    }

    public function getDiasPagVencimento() {
        return $this->dias_pag_vencimento;
    }

    public function getNumeroDocumento() {
        return $this->numero_documento;
    }

    public function getSequencial() {
        return $this->sequencial;
    }

    public function getAceite() {
        return $this->aceite;
    }

    public function getLocalPagamento() {
        return $this->local_pagamento;
    }

    /**
     * 
     * @return Retorno
     */
    public function getRetorno() {
        return $this->retorno;
    }

}
