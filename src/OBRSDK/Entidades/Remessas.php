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
     *
     * @var \OBRSDK\Entidades\Boletos[]
     */
    public $boletos;
    ///
    /// ATRIBUTOS OPCIONAIS
    ///
    public $cnab;

}
