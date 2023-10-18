<?php 
namespace app\models\service;

use app\models\dao\ProdutoDao;
use app\models\validacao\ProdutoValidacao;

class ProdutoService {
    public static function salvar($produto, $campo, $tabela) {
        $validacao = ProdutoValidacao::salvar($produto); 
        return Service::salvar($produto, $campo, $validacao->listaErros(), $tabela); 
    }

    public static function lista() {
        $dao = new ProdutoDao(); 
        return $dao->lista(); 
    }
    public static function getProduto($id_produto) {
        $dao = new ProdutoDao(); 
        return $dao->getProduto($id_produto); 
    }
}