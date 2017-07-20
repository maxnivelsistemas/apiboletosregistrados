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

    ///
    /// GETS DOS ATRIBUTOS DE RESPOSTA
    ///

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

}
