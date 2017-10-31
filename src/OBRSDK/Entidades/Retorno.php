<?php

namespace OBRSDK\Entidades;

/**
 * @author Antonio
 * @since 31/10/2017
 */
class Retorno extends \OBRSDK\Entidades\Abstratos\AEntidadePropriedades {

    protected $codigo_movimento;
    protected $pagador_documento;
    protected $pagador_nome;
    protected $valor_tarifa;
    protected $motivo_ocorrencia;
    protected $valor_acrescimo;
    protected $valor_desconto;
    protected $valor_abatimento;
    protected $valor_iof;
    protected $valor_pago;
    protected $valor_liquido;
    protected $valor_outras_despesas;
    protected $valor_outros_creditos;
    protected $data_ocorrencia;
    protected $data_credito;
    protected $ocorrencia_pag_codigo;
    protected $ocorrencia_pag_data;
    protected $ocorrencia_pag_valor;
    protected $ocorrencia_complemento;

    public function getCodigoMovimento() {
        return $this->codigo_movimento;
    }

    public function getPagadorDocumento() {
        return $this->pagador_documento;
    }

    public function getPagadorNome() {
        return $this->pagador_nome;
    }

    public function getValorTarifa() {
        return $this->valor_tarifa;
    }

    public function getMotivoOcorrencia() {
        return $this->motivo_ocorrencia;
    }

    public function getValorAcrescimo() {
        return $this->valor_acrescimo;
    }

    public function getValorDesconto() {
        return $this->valor_desconto;
    }

    public function getValorAbatimento() {
        return $this->valor_abatimento;
    }

    public function getValorIof() {
        return $this->valor_iof;
    }

    public function getValorPago() {
        return $this->valor_pago;
    }

    public function getValorLiquido() {
        return $this->valor_liquido;
    }

    public function getValorOutrasDespesas() {
        return $this->valor_outras_despesas;
    }

    public function getValorOutrosCreditos() {
        return $this->valor_outros_creditos;
    }

    public function getDataOcorrencia() {
        return $this->data_ocorrencia;
    }

    public function getDataCredito() {
        return $this->data_credito;
    }

    public function getOcorrenciaPagCodigo() {
        return $this->ocorrencia_pag_codigo;
    }

    public function getOcorrenciaPagData() {
        return $this->ocorrencia_pag_data;
    }

    public function getOcorrenciaPagValor() {
        return $this->ocorrencia_pag_valor;
    }

    public function getOcorrenciaComplemento() {
        return $this->ocorrencia_complemento;
    }

}
