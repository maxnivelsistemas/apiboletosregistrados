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

}
