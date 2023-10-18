<?php 
namespace app\models\service;

class MedicoService {
    public static function salvar($cliente, $campo, $tabela) {

    }
    public static function getTotal() {
       
        $lista = Service::lista('medicos'); 
        $contador = 0;
        foreach($lista as $item) {
            $contador++; 
        }
        return $contador; 
    }
}