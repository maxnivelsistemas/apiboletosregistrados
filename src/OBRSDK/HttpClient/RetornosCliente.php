<?php

namespace OBRSDK\HttpClient;

/**
 * @author Antonio
 * @since 19/10/2017
 */
class RetornosCliente extends Nucleo\Instancia {

    /**
     * Faz o upload do arquivo de retorno do banco para a API
     * 
     * @param string $arquivo
     * @return \OBRSDK\Entidades\Retornos Lista de boletos e propriedades que 
     * foram processados pelo arquivo de retorno
     */
    public function enviarArquivoRetorno($arquivo) {
        $resposta = $this->apiCliente->addAuthorization()
                ->enviarArquivo('retornos', $arquivo)
                ->getResposta(true);

        $respostaEntidade = new \OBRSDK\Entidades\Retornos();
        $respostaEntidade->setAtributos($resposta);

        return $respostaEntidade;
    }

}
