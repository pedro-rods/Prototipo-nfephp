<?php 
namespace app\models\service;

use app\models\validacao\ItemVendaValidacao;
use app\models\dao\ItemVendaDao;

class ItemVendaService {
    public static function salvar($item, $campo, $tabela) {
        $validacao = ItemVendaValidacao::salvar($item); 
        return Service::salvar($item, $campo, $validacao->listaErros(), $tabela); 
    }

    public static function listaPorVenda($id_venda) {
        $dao = new ItemVendaDao(); 
        return $dao->listaPorVenda($id_venda); 


    }
}