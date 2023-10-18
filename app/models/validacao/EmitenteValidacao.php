<?php

namespace app\models\validacao; 

use app\core\Validacao;

 class EmitenteValidacao {
    public static function salvar($emitente) {
        $validacao = new Validacao(); 

        $validacao->setData('razao_social', $emitente->razao_social); 
        $validacao->setData('nome_fantasia', $emitente->nome_fantasia); 
        $validacao->setData('cnpj', $emitente->cnpj); 
        $validacao->setData('cep', $emitente->cep); 
        $validacao->setData('logradouro', $emitente->logradouro); 
        $validacao->setData('numero', $emitente->numero); 
        $validacao->setData('bairro', $emitente->bairro); 
        $validacao->setData('ibge', $emitente->ibge); 
        $validacao->setData('regime_tributario', $emitente->regime_tributario); 

        //fazendo a validacao
        $validacao->getData('razao_social')->isVazio();
        $validacao->getData('nome_fantasia')->isVazio();
        $validacao->getData('cnpj')->isVazio()->isCNPJ();
        $validacao->getData('cep')->isVazio();
        $validacao->getData('logradouro')->isVazio();
        $validacao->getData('numero')->isVazio();
        $validacao->getData('bairro')->isVazio();
        $validacao->getData('ibge')->isVazio();
        $validacao->getData('regime_tributario')->isVazio();

        return $validacao; 
    }
 }