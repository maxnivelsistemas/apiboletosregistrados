[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/antoniojoaojr/obrsdk/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/antoniojoaojr/obrsdk/?branch=master)
# obrsdk
SDK em PHP para API Objeto Boletos Registrados

Exemplo Configuração ambiente desenvolvimento:
```
$boletosRegistradosAccess = new \OBRSDK\ObjetoBoletosRegistrados([
                'appId' => 'APP_ID',
                'appSecret' => 'APP_SECRET',
                'http://boletosregistrados.local/api.php/'
            ]);
```

