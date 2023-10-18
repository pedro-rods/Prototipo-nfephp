<?php

require 'config.php';
class Medico
{
   
    public function adicionar($email, $nome = '', $cpf, $crm, $telefone, $horario)
    { // passo 1:  verficar se o email já existe no sistema
        // passo 2: adicionar
        global $pdo;

        if ($this->existeId($email) == false ) {
            $sql = $pdo->prepare("INSERT INTO medicos (nome, email, cpf, crm, telefone, horario) VALUES (:nome, :email, :cpf, :crm, :telefone, :horario)");            
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':cpf', $cpf);
            $sql->bindValue(':crm', $crm);
            $sql->bindValue(':telefone', $telefone);
            $sql->bindValue(':horario', $horario);
            $sql->execute(); 

            return true; 
        } else {
            return false; 
        }

    }
    public function getInfo($id)
    { 
        global $pdo; 

        $sql = $pdo->prepare("SELECT * FROM medicos WHERE id = :id"); 
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch(); 
        } else {
            return array(); 
        }
        
    }   
    
    public function getAll()
    { 
        global $pdo; 

        $sql = $pdo->query("SELECT * FROM medicos"); 

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll(); 
        } else {
            return array(); 
        }
        
    }   
    public function editar($id, $nome, $email, $cpf, $crm, $telefone)
    {
        global $pdo; 

         if($this->existeId($id)) {
            $sql = $pdo->prepare("UPDATE medicos set nome = :nome, email = :email, cpf = :cpf, crm = :crm, telefone = :telefone where medicos.id = :id"); 
            $sql->bindValue(':nome', $nome); 
            $sql->bindValue(':email', $email);
            $sql->bindValue(':cpf', $cpf);
            $sql->bindValue(':crm', $crm);
            $sql->bindValue(':telefone', $telefone);
            $sql->bindValue(':id', $id); 
            $sql->execute(); 
            return true;

        } else {
            return false; 
        }
    }
    public function excluirPeloId($id)
    {       global $pdo;

            $sql = $pdo->prepare("DELETE FROM medicos WHERE medicos.id = :id"); 
            $sql->bindValue(':id', $id); 
            $sql->execute();
    }

    public function excluirPeloEmail($email)
    {   
        global $pdo;
        
        $sql = $pdo->prepare("DELETE FROM medicos WHERE email = :email"); 
        $sql->bindValue(':email', $email); 
        $sql->execute();
        return true; 
    }
    
    
    private function existeId($id)
    { 
        global $pdo;

        $sql = $pdo->prepare("SELECT * FROM medicos WHERE id = :id"); 
        $sql->bindValue(':id', $id);
        $sql->execute(); 

        if ($sql->rowCount() > 0) {          
            return true; 
        } else {
             return false; 
        }

    }
    public function existeCPF($cpf)
    { 
        global $pdo;
 
        $sql = $pdo->prepare("SELECT * FROM medicos WHERE cpf = :cpf"); 
        $sql->bindValue(':cpf', $cpf);
        $sql->execute(); 

        if ($sql->rowCount() > 0) {          
            return true; 
        } else {
             return false; 
        }

    }
    public function getTotalMedicos() {
        
        global $pdo;
 
        $sql = $pdo->query("SELECT COUNT(*) as c from medicos"); 
        $row = $sql->fetch();
        return $row['c']; 
    }

    public function login($email, $cpf) {
        global $pdo;

        $sql = $pdo->prepare ('SELECT id FROM medicos where email = :email and cpf = :cpf'); 
        $sql->bindValue(':email', $email);
        $sql->bindValue(':cpf', $cpf); 
        $sql->execute(); 

        if($sql->rowCount() > 0) {
            $dado = $sql->fetch(); 
            $_SESSION['id'] = $dado['id'];
            return $dado['id']; 
        } else {
            return false; 
        }
    }

 
}
?>