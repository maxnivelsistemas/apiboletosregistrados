<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OBRSDK\Exceptions;

/**
 * Description of BaseExceptions
 *
 * @author Antonio
 */
class RespostaException extends \Exception {

    private $status;
    private $titulo;
    private $mensagem;
    private $error;
    private $show;

    public function __construct($response, $show = null) {
        $body = json_decode($response);

        if (isset($body->status)) {
            $this->status = $body->status;
        }
        if (isset($body->titulo)) {
            $this->titulo = $body->titulo;
        }

        if (isset($body->mensagem)) {
            $this->mensagem = $body->mensagem;
        }
        if (isset($body->error)) {
            $this->error = $body->error;
        }

        if ($show != null) {
            $this->show = null;
        }

        parent::__construct($this->mensagem);
    }

    public function getStatus() {
        return $this->status;
    }

    public function getTitulo() {
        return $this->titulo;
    }

    public function getMensagem() {
        return $this->mensagem;
    }

    public function getError() {
        return $this->error;
    }

    public function getShow() {
        return $this->show;
    }

}
