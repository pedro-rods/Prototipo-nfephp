<?php 
  if(!isset($_SESSION)) { 
      session_start(); 
  } 

global $pdo;
try {
    $pdo = new PDO("mysql:dbname=cadastros;host=localhost", "root", "");
} catch(PDOexception $e) {
    echo 'Falhou: '.$e->getMessage();
    exit;
}

