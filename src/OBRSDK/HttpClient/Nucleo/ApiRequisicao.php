<?php

namespace OBRSDK\HttpClient\Nucleo;

/**
 * @author Antonio
 * @since 01/11/2017
 */
class ApiRequisicao extends \OBRSDK\DebugMode {

    /**
     *
     * @var \GuzzleHttp\Client 
     */
    private $cliente;
    private $tipoRequisicao;
    private $urlRequisicao;

    /**
     *
     * @var ApiData
     */
    private $data;

    public function __construct(\GuzzleHttp\Client $cliente, $tipoRequisicao, $urlRequisicao, ApiData $data) {
        $this->cliente = $cliente;
        $this->tipoRequisicao = $tipoRequisicao;
        $this->urlRequisicao = $urlRequisicao;
        $this->data = $data;
    }

    /**
     * 
     * @return string
     */
    public function getRespostaConteudo() {
        $this->debugDadosEnviado($this->urlRequisicao, $this->tipoRequisicao, $this->data->getData());
        try {
            $respostaRequisicao = $this->requisitarHttp();
            $conteudoRecebido = $respostaRequisicao->getBody()->getContents();
            $this->debugDadosRecebido($this->urlRequisicao, $this->tipoRequisicao, $conteudoRecebido, $respostaRequisicao->getHeaders(), $respostaRequisicao->getStatusCode());

            return $conteudoRecebido;
        } catch (\GuzzleHttp\Exception\BadResponseException $ex) {
            $resultado = $ex->getResponse()->getBody()->getContents();
            $this->debugDadosRecebido($this->urlRequisicao, $this->tipoRequisicao, $resultado, $ex->getResponse()->getHeaders(), $ex->getResponse()->getStatusCode());
            throw new \OBRSDK\Exceptions\RespostaException($resultado);
        }
    }

    private function requisitarHttp() {
        if ($this->data->getDataSize() > 0) {
            return $this->cliente->request($this->tipoRequisicao, $this->urlRequisicao, $this->data->getData());
        } else {
            return $this->cliente->request($this->tipoRequisicao, $this->urlRequisicao);
        }
    }

}
