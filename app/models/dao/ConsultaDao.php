<?php 
namespace app\models\dao; 
use app\core\Model;

class ConsultaDao extends Model {
    public function salvar($dados) {
        $dados = objToArray($dados); 
       
        $sql = $this->db->prepare("INSERT INTO consultas set user_id = :user_id, title = :title, descricao = :descricao, start = :horario_inicial, end = :horario_final"); 
        
        $sql->bindValue(':user_id', $dados['user_id']); 
        $sql->bindValue(':title', $dados['title']); 
        $sql->bindValue(':descricao', $dados['desc']); 
        $sql->bindValue(':horario_inicial', $dados['start']);
        $sql->bindValue(':horario_final', $dados['end']);  
        $sql->execute(); 
    }
    public function editar($dados) {
        $dados = objToArray($dados); 
       
        $sql = $this->db->prepare("UPDATE consultas set user_id = :user_id, title = :title, descricao = :descricao, start = :horario_inicial, end = :horario_final where id = :id"); 
        
        $sql->bindValue(':id', $dados['id']); 
        $sql->bindValue(':user_id', $dados['user_id']); 
        $sql->bindValue(':title', $dados['title']); 
        $sql->bindValue(':descricao', $dados['desc']); 
        $sql->bindValue(':horario_inicial', $dados['start']);
        $sql->bindValue(':horario_final', $dados['end']);  
        $sql->execute(); 
    }
    
    
}