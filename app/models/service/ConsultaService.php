<?php 
namespace app\models\service;

use app\models\dao\ConsultaDao;

class ConsultaService { 
    public static function salvar($dados) {
        $dao = new ConsultaDao();
        $dao->salvar($dados); 
    }
    public static function editar($dados) {
        $dao = new ConsultaDao();
        $dao->editar($dados); 
    }
    public static function excluir($id_consulta) {
        Service::excluir("consultas", "id", $id_consulta); 
    }
}   