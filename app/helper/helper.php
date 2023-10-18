<?php
function i($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
    exit;
}

function tira_mascara($valor){
    return  preg_replace("/\D+/", "", $valor);
}

function objToArray($objeto){
    return is_array($objeto) ? $objeto : (array) $objeto;
}
function tiraAcento($str){
    # special accents
    $a = array('À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','Ð','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','?','?','J','j','K','k','L','l','L','l','L','l','?','?','L','l','N','n','N','n','N','n','?','O','o','O','o','O','o','Œ','œ','R','r','R','r','R','r','S','s','S','s','S','s','Š','š','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Ÿ','Z','z','Z','z','Ž','ž','?','ƒ','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','?','?','?','?','?','?');
    $b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','U','u','U','u','U','u','U','u','A','a','AE','ae','O','o');
    return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/','/[ -]+/','/^-|-$/'),array('','-',''),str_replace($a,$b,$str)));
}
function deixaNumeros($str){
    $retorno = preg_replace('/[^0-9]/', '', $str);;
    return $retorno; 
}
function validaEmail($email){  
    $conta = "/[a-zA-Z0-9\._-]+@";
    $domino = "[a-zA-Z0-9\._-]+.";
    $extensao = "([a-zA-Z]{2,4})$/";
    $pattern = $conta.$domino.$extensao;    
    if (preg_match($pattern, $email))
        return true;
    else
        return false;
 }
 

 
 function validaCPF($cpf){     
     // Extrai somente os números
     $cpf = preg_replace('/[^0-9]/is', '', $cpf);
     
     // Verifica se foi informado todos os digitos corretamente
     if (strlen($cpf) != 11) {
         return false;
     }
     
     // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
     if (preg_match('/(\d)\1{10}/', $cpf)) {
         return false;
     }
     
     // Faz o calculo para validar o CPF
     for ($t = 9; $t < 11; $t ++) {
         for ($d = 0, $c = 0; $c < $t; $c ++) {
             $d += $cpf[$c] * (($t + 1) - $c);
         }
         
         $d = ((10 * $d) % 11) % 10;
         if ($cpf[$c] != $d) {
             return false;
         }
     }
     return true;
 }
 
 function validaCNPJ($cnpj) {
     $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
     
     // Valida tamanho
     if (strlen($cnpj) != 14)
         return false;
         
         // Verifica se todos os digitos são iguais
         if (preg_match('/(\d)\1{13}/', $cnpj))
             return false;
             
             // Valida primeiro dígito verificador
             for ($i = 0, $j = 5, $soma = 0; $i < 12; $i ++) {
                 $soma += $cnpj[$i] * $j;
                 $j = ($j == 2) ? 9 : $j - 1;
             }
             
             $resto = $soma % 11;
             
             if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
                 return false;
                 
                 // Valida segundo dígito verificador
                 for ($i = 0, $j = 6, $soma = 0; $i < 13; $i ++) {
                     $soma += $cnpj[$i] * $j;
                     $j = ($j == 2) ? 9 : $j - 1;
                 }
                 
                 $resto = $soma % 11;
                 
                 return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
 }
 

 ///
 function upload($arq, $config_upload){
     set_time_limit(0);
     $nome_arquivo 		 = $_FILES[$arq]["name"];
     $tamanho_arquivo 	 = $_FILES[$arq]["size"];
     $arquivo_temporario = $_FILES[$arq]["tmp_name"];
     $erro               = 0;
     $msg                = "";
     $retorno            = array();
     if(!empty($nome_arquivo)){
         $ext        = strrchr($nome_arquivo, ".");
         $nome_final = ($config_upload["renomeia"]) ? md5(time()) . $ext:  $nome_arquivo;
         $caminho    = $config_upload["caminho_absoluto"] .$nome_final;
         
         
         if (($config_upload["verifica_tamanho"]) && ($tamanho_arquivo > $config_upload["tamanho"])){
             $msg ="O arquivo é maior que o permitido" ;
             $erro = -1;
         }
         
         if(($config_upload["verifica_extensao"]) && (!in_array($ext,$config_upload["extensoes"]))){
             $msg ="O arquivo não é permitido para upload";
             $erro = -1;
         }
         
         if($erro !=-1){
             if(move_uploaded_file($arquivo_temporario, $caminho)){
                 $msg    =  "Arquivo enviado com sucesso";
                 $erro   =  0;
             }else{
                 $msg    = "erro ao fazer o upload";
                 $erro   = -1;
             }
         }
         
     }else{
         $msg = "Arquivo vazio";
         $erro = -1;
     }
     $retorno = (object) array("erro" => $erro, "msg"=> $msg, "nome"=>$nome_final);
     return $retorno;
 }
 

 
 