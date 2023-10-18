<?php 
namespace app\models\dao; 
use app\core\Model;

class ProdutoDao extends Model {
    public function lista() {
        $sql = "SELECT * FROM produto p, unidade u WHERE p.id_unidade = u.id_unidade"; 
        return $this->select($this->db, $sql); 
    }
    public function getProduto($id_produto) {
        $sql = "SELECT * FROM produto p, unidade u WHERE p.id_unidade = u.id_unidade AND id_produto = $id_produto"; 
        return $this->select($this->db, $sql, false); 
    }
    
}