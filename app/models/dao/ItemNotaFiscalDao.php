<?php 
namespace app\models\dao; 
use app\core\Model;

class ItemNotaFiscalDao extends Model {
    public function existeItem($id_nfe, $id_produto) {
        $sql = "SELECT * FROM nfe_item
        WHERE cProd = $id_produto 
        AND id_nfe= $id_nfe"; 
        return $this->select($this->db, $sql); 
    }
   
}