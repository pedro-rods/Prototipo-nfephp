<?php

namespace app\models\validacao; 

use app\core\Validacao;

 class ProdutoValidacao {
    public static function salvar($produto) {
        $validacao = new Validacao(); 

        $validacao->setData('id_unidade', $produto->id_unidade); 
        $validacao->setData('produto', $produto->produto); 
        $validacao->setData('preco', $produto->preco); 

        //fazendo a validacao
        $validacao->getData('id_unidade')->isVazio();
        $validacao->getData('produto')->isVazio();
        $validacao->getData('preco')->isVazio();
        return $validacao; 
    }
 }