<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Entidades;

/**
 * Description of Remessas
 *
 * @author Antonio
 */
class Remessas extends \OBRSDK\Entidades\Abstratos\AEntidadePropriedades {

    ///
    /// ATRIBUTOS DE RESPOSTA
    /// 
    protected $remessa_id;
    protected $nome_banco;

    /**
     *
     * @var \OBRSDK\Entidades\Beneficiario 
     */
    protected $beneficiario;
    protected $link;
    ///
    /// ATRIBUTOS OBRIGATORIOS
    ///
    /**
     * @var \OBRSDK\Entidades\Boletos[]
     */
    public $boletos;
    ///
    /// ATRIBUTOS OPCIONAIS
    ///
    public $cnab;

    public function __construct() {
        // inicia o objeto
        $this->beneficiario = new Beneficiario();

        // inicia o array de objeto
        $this->boletos = [new Boletos()];
    }

    public function getRemessaId() {
        return $this->remessa_id;
    }

    public function getNomeBanco() {
        return $this->nome_banco;
    }

    /**
     *
     * @var \OBRSDK\Entidades\Beneficiario 
     */
    public function getBeneficiario() {
        return $this->beneficiario;
    }

    public function getLink() {
        return $this->link;
    }

}
