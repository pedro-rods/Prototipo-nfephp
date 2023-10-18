<?php 
namespace app\models\dao; 
use app\core\Model;

class VendaDao extends Model {
    public function lista() {
        $sql = "SELECT * FROM venda v, cliente c WHERE v.id_cliente = c.id_cliente"; 
        return $this->select($this->db, $sql); 
    }
    public function getProduto($id_venda) {
        $sql = "SELECT * FROM venda v, cliente c WHERE v.id_cliente = c.id_cliente and id_venda = $id_venda";  
        return $this->select($this->db, $sql, false); 
    }
    
}