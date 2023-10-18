<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\Service;
use app\models\service\MedicoService;

class MedicoController extends Controller{
   private $tabela = "medicos";
   private $campo  = "id_medico"; 
   
    public function index(){
       $dados["lista"] = Service::lista($this->tabela); 
       $dados["view"]  = "Medico/Index";
       $dados['total'] = MedicoService::getTotal(); 
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["medico"]    = Flash::getForm();      
        $dados["view"]      = "Medico/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id_medico){
        $Medico = Service::get($this->tabela, $this->campo, $id_medico);       
        if(!$Medico){
            $this->redirect(URL_BASE."Medico");
        }
        
        $dados["medico"]   = $Medico;
        $dados["view"]      = "Medico/Create";
        $this->load("template", $dados);
    }
    public function salvar () {

     }
    
    
   
    
}

