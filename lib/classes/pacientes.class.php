<?php 
require 'config.php'; 

    class Pacientes {

        public function getAll() {
            global $pdo; 

            $sql = $pdo->query("SELECT * FROM pacientes");

            if ($sql->rowCount() > 0) {
                return $sql->fetchAll();
            } else {
                return array(); 
            }
        }

        public function getPacientes ($id) {
            global $pdo; 

            $sql = $pdo->prepare('SELECT * from pacientes where id = :id'); 
            $sql->bindValue(':id', $id);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $array = $sql->fetch();
                return $array;  
            } else {
                return array(); 
            }
        }
        public function login($email, $senha) {
            global $pdo; 

            $sql = $pdo->prepare ('SELECT id FROM pacientes where email = :email and senha = :senha'); 
            $sql->bindValue(':email', $email);
            $sql->bindValue(':senha', $senha); 
            $sql->execute(); 

            if($sql->rowCount() > 0) {
                $dado = $sql->fetch(); 
                $_SESSION['id'] = $dado['id'];
                return true;
            } else {
                return false; 
            }

        }

        public function existeCPF ($cpf) {
            global $pdo;

            $sql = $pdo->prepare('SELECT * from pacientes where cpf = :cpf');
            $sql->bindValue('cpf', $cpf);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false; 
            }

        }

        public function cadastrarPaciente($nome, $email, $cpf, $senha) {

            global $pdo;


            if ($this->existeCPF($cpf) == false){
            $sql = $pdo->prepare('INSERT INTO pacientes (nome, email, cpf, senha) values (:nome, :email, :cpf, :senha)');
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':cpf', $cpf);
            $sql->bindValue(':senha', $senha);
            $sql->execute();
            return true;

            } else {
                return false; 
            }
        }

        public function getTotalPacientes() {
        
            global $pdo;
     
            $sql = $pdo->query("SELECT COUNT(*) as c from pacientes"); 
            $row = $sql->fetch();
            return $row['c']; 
        }
    }