<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\HttpClient\Nucleo;

/**
 * Description of Instancia
 *
 * @author Antonio
 */
abstract class Instancia {

    private $instancia;

    /**
     *
     * @var \OBRSDK\HttpClient\Nucleo\ApiCliente
     */
    protected $apiCliente;

    public function __construct(\OBRSDK\ObjetoBoletosRegistrados $instancia) {
        $this->instancia = $instancia;
        $this->apiCliente = new ApiCliente($instancia);
    }

    /**
     * 
     * @return \OBRSDK\ObjetoBoletosRegistrados
     */
    public function getInstancia() {
        return $this->instancia;
    }

    /**
     * 
     * @param string $index
     * @param \OBRSDK\Entidades\Abstratos\AEntidadePropriedades $entidade
     * @return array
     */
    protected function getListaEntidade($index, \OBRSDK\Entidades\Abstratos\AEntidadePropriedades $entidade) {
        $resposta = $this->apiCliente
                ->getRespostaArray();

        $lista = [];
         foreach ($resposta[$index] as $resultado) {
            $entidadeTmp = clone $entidade;
            $entidadeTmp->setAtributos($resultado);
            $lista[] = $entidadeTmp;
        }

        return $lista;
    }

}
