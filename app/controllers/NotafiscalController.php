<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\NotaFiscalService;
use app\models\service\Service;

class NotafiscalController extends Controller{

   
    public function index(){
        $dados['lista']     = NotaFiscalService::lista(); 
        $dados["view"]      = "NotaFiscal/Index";
        $this->load("template", $dados);
    }        
    
    public function create(){
        $dados["view"] 		   = "NotaFiscal/Create";
        $this->load("template", $dados);
    }
    
    public function edit($id){      
        $dados['notafiscal'] =  NotafiscalService::getNotaFiscal($id); 
        $dados["view"]          = "NotaFiscal/Edit";
        $this->load("template", $dados);
    }
    public function salvarNota($id_venda) {
        NotaFiscalService::salvarNota($id_venda);    
        $this->redirect(URL_BASE."notafiscal");    
    }

    

    }    
    
    
   
    
    


