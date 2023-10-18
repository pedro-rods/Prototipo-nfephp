<?php 
namespace app\models\service;

use app\models\validacao\ClienteValidacao;

class ClienteService {
    public static function salvar($cliente, $campo, $tabela) {
        $validacao = ClienteValidacao::salvar($cliente); 
        return Service::salvar($cliente, $campo, $validacao->listaErros(), $tabela); 
    }
    public static function getTotal() {
        $lista = Service::lista('cliente'); 
        $contador = 0;
        foreach($lista as $item) {
            $contador++; 
        }
        return $contador; 
    }
}
