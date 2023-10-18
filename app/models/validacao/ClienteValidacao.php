<?php

namespace app\models\validacao; 

use app\core\Validacao;
 
 class ClienteValidacao {
    public static function salvar($cliente) {
        $validacao = new Validacao(); 

        $validacao->setData('nome', $cliente->nome); 
        $validacao->setData('nome_fantasia', $cliente->nome_fantasia); 
        $validacao->setData('cnpj', $cliente->cnpj); 
        $validacao->setData('cpf', $cliente->cpf); 
        $validacao->setData('cep', $cliente->cep); 
        $validacao->setData('logradouro', $cliente->logradouro); 
        $validacao->setData('numero', $cliente->numero); 
        $validacao->setData('bairro', $cliente->bairro); 
        $validacao->setData('ibge', $cliente->ibge);  
        $validacao->setData('ie', $cliente->ie); 
        $validacao->setData('indIEDest', $cliente->indIEDest);
        

        //fazendo a validacao
        $validacao->getData('razao_social')->isVazio();
        $validacao->getData('nome_fantasia')->isVazio();

        if ($cliente->cnpj) {
        $validacao->getData('cnpj')->isCNPJ();
        }
        
        if ($cliente->cpf){
        $validacao->getData('cpf')->isCPF();
        }
        if ($cliente->indIEDest==1){
            $validacao->getData('ie')->isVazio("É obrigatório digitar a Inscrição Estadual 'IE' ");
        }
        if ($cliente->ie){
            if ($cliente->indIEDest!=1) {
                $cliente->indIEDest = null; 
                $validacao->getData('indIEDest')->isVazio("O campo de Inscrição Estadual não pode ter valor");
            }
        }
            

        $validacao->getData('cep')->isVazio();
        $validacao->getData('logradouro')->isVazio();
        $validacao->getData('numero')->isVazio();
        $validacao->getData('bairro')->isVazio();
        $validacao->getData('ibge')->isVazio(); 

        return $validacao; 
    }
 }