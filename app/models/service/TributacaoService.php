<?php 
namespace app\models\service;

use app\models\validacao\TributacaoValidacao;

class TributacaoService {
    public static function salvar($cliente, $campo, $tabela) {
        $validacao = TributacaoValidacao::salvar($cliente); 
        return Service::salvar($cliente, $campo, $validacao->listaErros(), $tabela); 
    }
}