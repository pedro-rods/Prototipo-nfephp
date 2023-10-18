<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\Service;
use app\models\service\ClienteService;

class ClienteController extends Controller{
   private $tabela = "cliente";
   private $campo  = "id_cliente"; 
   
    public function index(){
       $dados["lista"] = Service::lista($this->tabela); 
       $dados["view"]  = "Cliente/Index";
       $dados["total"] = ClienteService::getTotal(); 
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["cliente"]   = Flash::getForm();      
        $dados["view"]      = "Cliente/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){
        $cliente = Service::get($this->tabela, $this->campo, $id);       
        if(!$cliente){
            $this->redirect(URL_BASE."cliente");
        }
        
        $dados["cliente"]   = $cliente;
        $dados["view"]      = "Cliente/Create";
        $this->load("template", $dados);
    }
    public function salvar () {
        $cliente = new \stdClass;
        $cliente->id_cliente                   = ($_POST['id_cliente']) ? $_POST['id_cliente'] : null;
        $cliente->nome                         = $_POST['nome']; 
        $cliente->nome_fantasia                = $_POST['nome_fantasia']; 
        $cliente->cnpj                         = tira_mascara($_POST['cnpj']); 
        $cliente->cpf                          = tira_mascara($_POST['cpf']); 
        $cliente->ie                           = $_POST['ie']; 
        $cliente->im                           = $_POST['im']; 
        $cliente->fone                         = tira_mascara($_POST['celular']); 
        $cliente->email                        = $_POST['email'];  
        $cliente->cep                          = tira_mascara($_POST['cep']); 
        $cliente->logradouro                   = $_POST['logradouro']; 
        $cliente->fone                         = tira_mascara($_POST['fone']); 
        $cliente->celular                      = tira_mascara($_POST['celular']); 
        $cliente->numero                       = $_POST['numero']; 
        $cliente->bairro                       = $_POST['bairro']; 
        $cliente->complemento                  = $_POST['complemento']; 
        $cliente->uf                           = $_POST['uf']; 
        $cliente->cidade                       = $_POST['cidade']; 
        $cliente->ibge                         = $_POST['ibge']; 
        $cliente->indIEDest                    = $_POST['indIEDest']; 
        $cliente->idEstrangeiro                = $_POST['idEstrangeiro'];
        
        Flash::setForm($cliente); 
       $retorno = ClienteService::salvar($cliente, $this->campo, $this->tabela); 
        if($retorno->resultado){
            $this->redirect(URL_BASE."cliente"); 
        } else {
            if($cliente->id) {
                $this->redirect(URL_BASE."cliente/edit/". $cliente->id); 
            } else {
                $this->redirect(URL_BASE."cliente/create"); 
            }
        }

    }
    
    
   
    
}

