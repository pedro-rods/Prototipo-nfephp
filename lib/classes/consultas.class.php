<?php 

require 'config.php';
class Consultas {


    public function getEvents() {
        global $pdo;


        $sql = $pdo->prepare("SELECT * from consultas");
        $sql->execute(); 

        return json_encode($sql->fetchAll()); 

    }

    public function adicionarConsulta($user_id,$title,$desc,$start,$end) {
        global $pdo;


        $sql = $pdo->prepare('INSERT INTO consultas set user_id = :user_id, title = :title, descricao = :descricao, start = :horario_inicial, end = :horario_final');

        $sql->bindValue(':user_id', $user_id); 
        $sql->bindValue(':title', $title); 
        $sql->bindValue(':descricao', $desc); 
        $sql->bindValue(':horario_inicial', $start->format("Y-m-d H:m:s"));
        $sql->bindValue(':horario_final', $end->format("Y-m-d H:m:s"));  
        $sql->execute(); 
        return true;

    }

    public function getConsulta($id) {
        global $pdo; 

        $sql = $pdo->prepare('SELECT * FROM consultas where id = :id');
        $sql->bindValue(':id', $id); 
        $sql->execute(); 

        if ($sql->rowCount() > 0) {
            return $sql->fetch(); 
        } else {
            return array(); 
        }
    }
    
    public function editarConsulta($id,$user_id,$title,$desc,$start,$end) {
        global $pdo;


        $sql = $pdo->prepare('UPDATE consultas set user_id = :user_id, title = :title, descricao = :descricao, start = :horario_inicial, end = :horario_final WHERE id = :id');

        $sql->bindValue(':user_id', $user_id); 
        $sql->bindValue(':title', $title); 
        $sql->bindValue(':descricao', $desc); 
        $sql->bindValue(':horario_inicial', $start->format("Y-m-d H:m:s"));
        $sql->bindValue(':horario_final', $end->format("Y-m-d H:m:s")); 
        $sql->bindValue(':id', $id);  
        $sql->execute(); 
        return true;


        }

    public function excluirConsulta($id) {
        global $pdo;

        $sql = $pdo->prepare('DELETE from consultas where id = :id');
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;  
    }

    public function getTotalConsultasPaciente($id) {
        
        global $pdo;
 
        $sql = $pdo->prepare("SELECT COUNT(*) as c from consultas where user_id = :id");
        $sql->bindValue(':id', $id);  
        $sql->execute(); 
        $row = $sql->fetch();
        return $row['c']; 
    }

    public function getConsultasdoPaciente($id) {
        global $pdo; 

        $sql = $pdo->prepare('SELECT * FROM consultas where user_id = :id');
        $sql->bindValue(':id', $id); 
        $sql->execute(); 

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(); 
        } else {
            return array(); 
        }
    }
  
}