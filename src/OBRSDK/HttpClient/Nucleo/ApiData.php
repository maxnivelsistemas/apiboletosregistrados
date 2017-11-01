<?php

namespace OBRSDK\HttpClient\Nucleo;

/**
 * @author Antonio
 * @since 01/11/2017
 */
class ApiData {

    /**
     *
     * @var array
     */
    private $data;

    /**
     *
     * @var int
     */
    private $dataSize = 0;

    public function __construct($data = null) {
        if (is_null($data)) {
            $data = [];
        }

        if (!is_array($data)) {
            throw new \Exception("Parametro data deve ser um formato array em OBRSDK\HttpClient\Nucleo\HttpCliente->request");
        }

        $this->dataSize = count($data);
        $this->data = $data;

        $this->verificarSeArquivo();
    }

    /**
     * 
     * @return array
     */
    public function getData() {
        return $this->data;
    }

    public function getDataSize() {
        return $this->dataSize;
    }

    /**
     * 
     * @param array $headers
     */
    public function addHeaders(array $headers) {
        if (count($headers) == 0) {
            return;
        }

        $this->data = array_merge([
            'headers' => $headers
                ], $this->data);

        $this->dataSize = count($this->data);
    }

    private function verificarSeArquivo() {
        if (!isset($this->data['__uploadfile__'])) {
            return;
        }

        $this->data = [
            'multipart' => [
                [
                    'name' => 'uploadArquivo',
                    'contents' => file_get_contents($this->data['__uploadfile__']),
                    'filename' => basename($this->data['__uploadfile__'])
                ]
            ]
        ];

        $this->dataSize = 1;
    }

}
