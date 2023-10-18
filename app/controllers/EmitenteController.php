<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\EmitenteService;
use app\models\service\Service;

class EmitenteController extends Controller{
   private $tabela = "emitente";
   private $campo  = "id_emitente"; 
   
    public function index(){
       $dados["lista"] = Service::lista($this->tabela); 
       $dados["view"]  = "Emitente/Index";
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["emitente"]    = Flash::getForm();      
        $dados["view"] = "Emitente/Create";
        $this->load("template", $dados);
    }

    public function salvar () {
        $emitente = new \stdClass;
        $emitente->id_emitente                  = ($_POST['id_emitente']) ? $_POST['id_emitente'] : null;
        $emitente->razao_social                 = $_POST['razao_social']; 
        $emitente->nome_fantasia                = $_POST['nome_fantasia']; 
        $emitente->cnpj                         = tira_mascara($_POST['cnpj']); 
        $emitente->ie                           = $_POST['ie']; 
        $emitente->im                           = $_POST['im']; 
        $emitente->fone                         = tira_mascara($_POST['celular']); 
        $emitente->email                        = $_POST['email']; 
        $emitente->email_contabilidade          = $_POST['email_contabilidade']; 
        $emitente->cep                          = tira_mascara($_POST['cep']); 
        $emitente->logradouro                   = tiraAcento($_POST['logradouro']); 
        $emitente->numero                       = $_POST['numero']; 
        $emitente->bairro                       = tiraAcento($_POST['bairro']); 
        $emitente->complemento                  = $_POST['complemento']; 
        $emitente->uf                           = $_POST['uf']; 
        $emitente->cidade                       = $_POST['cidade']; 
        $emitente->ibge                         = tira_mascara($_POST['ibge']); 
        $emitente->cnae                         = $_POST['cnae']; 
        $emitente->regime_tributario            = $_POST['regime_tributario']; 
        
        Flash::setForm($emitente); 
       $retorno = EmitenteService::salvar($emitente, $this->campo, $this->tabela); 
        if($retorno->resultado){
            $this->redirect(URL_BASE."emitente"); 
        } else {
            if($emitente->id) {
                $this->redirect(URL_BASE."emitente/edit/". $emitente->id); 
            } else {
                $this->redirect(URL_BASE."emitente/create"); 
            }
        }

    }
    
    public function edit($id){
        $emitente = Service::get($this->tabela, $this->campo, $id);       
        if(!$emitente){
            $this->redirect(URL_BASE."emitente");
        }
        
        $dados["emitente"]   = $emitente;
        $dados["view"]      = "Emitente/Create";
        $this->load("template", $dados);
    }
     
    
    public function excluir($id){
        Service::excluir($this->tabela, $this->campo, $id);
        $this->redirect(URL_BASE."emitente");
    }
    
    
    
}

