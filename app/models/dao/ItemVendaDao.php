<?php 
namespace app\models\dao; 
use app\core\Model;

class ItemVendaDao extends Model {
    public function listaPorVenda($id_venda) {
        $sql = "SELECT * FROM item_venda i,produto p, unidade u 
        WHERE i.id_produto = p.id_produto 
        AND p.id_unidade = u.id_unidade
        AND i.id_venda = $id_venda"; 
        return $this->select($this->db, $sql); 
    }
    public function getProduto($id_venda) {
        $sql = "SELECT * FROM venda v, cliente c WHERE v.id_cliente = c.id_cliente and id_venda = $id_venda";  
        return $this->select($this->db, $sql, false); 
    }
    
}