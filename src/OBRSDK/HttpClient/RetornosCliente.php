<?php

namespace OBRSDK\HttpClient;

/**
 * @author Antonio
 * @since 19/10/2017
 */
class RetornosCliente extends Nucleo\Instancia {

    /**
     * Pega todos os arquivos de retornos já enviado para a API
     * 
     * @return \OBRSDK\Entidades\Retornos[]
     */
    public function getListaRetornos() {
        $resposta = $this->apiCliente->addAuthorization()
                        ->get('retornos')->getResposta(true);

        $retornos = [];
        foreach ($resposta->retornos as $retorno) {
            $retornoObjeto = new \OBRSDK\Entidades\Retornos();
            $retornoObjeto->setAtributos($retorno);

            $retornos[] = $retornoObjeto;
        }

        return $retornos;
    }

    /**
     * Se passado o parametro isFile como true, a identificacao deve ser 
     * o caminho para o arquivo.
     * Se não, deve ser o ID de retorno enviado anteriormente
     * 
     * @param string $identificacao
     * @param bool $isFile
     * @return \OBRSDK\Entidades\Retornos
     */
    public function getRetornoDados($identificacao, $isFile = false) {
        $this->apiCliente->addAuthorization();
        if ($isFile) {
            $this->apiCliente->enviarArquivo('retornos', $identificacao);
        } else {
            $this->apiCliente->get('retornos/' . $identificacao);
        }

        $resposta = $this->apiCliente->getResposta(true);

        if (!is_array($resposta)) {
            throw new \OBRSDK\Exceptions\RespostaException("Não é array");
        }

        $respostaEntidade = new \OBRSDK\Entidades\Retornos();
        $respostaEntidade->setAtributos($resposta);

        return $respostaEntidade;
    }

}
