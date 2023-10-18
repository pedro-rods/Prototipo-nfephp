<?php
namespace app\controllers;

use app\core\Controller;
use app\core\Flash;
use app\models\service\Service;
use app\models\service\ConsultaService;
use Exception;

class ConsultaController extends Controller{
   private $tabela = "consultas";
   private $campo  = "id"; 
   
    public function index(){
       $dados["lista"] = Service::lista($this->tabela); 
       $dados["view"]  = "consulta/Index";
       $this->load("template", $dados);
    }
    
    public function create(){
        $dados["consulta"]    = Flash::getForm();    
        if (isset($_GET['date'])) {    
        $dados["date"]      =  new \DateTime($_GET['date'], new \DateTimeZone('America/Sao_Paulo'));   
    }  else {
        $dados['date'] = new \DateTime();
    }
        $dados["view"]      = "consulta/Create";
        $this->load("template", $dados);
    }
    public function getEvents() {
        $dados = json_encode(Service::lista($this->tabela)); 
        echo $dados;  
    }
    
    public function editar($id_consulta){
        $consulta = Service::get($this->tabela, $this->campo, $id_consulta);       
        if(!$consulta){
            $this->redirect(URL_BASE."consulta");
        }
        
        $dados["date"]      =  new \DateTime($consulta->start, new \DateTimeZone('America/Sao_Paulo'));   
        $dados["consulta"]  = $consulta;
        $dados["view"]      = "consulta/editar";
        $this->load("template", $dados);
    }
    public function salvar () {
        try{
        $std = new \stdClass(); 

        $std->id        = ($_POST['id_consulta']) ? $_POST['id_consulta'] : null;
        $std->user_id   = '1'; 
        $std->medico_id = '1'; 
        $std->date      = ($_POST['date']);
        $std->time      = ($_POST['time']);
        $std->title     = ($_POST['title']);
        $std->desc      = ($_POST['description']);

        $start          = new \DateTime($std->date.' '.$std->time);
        $end            = $start->modify('+30minutes');

        $std->start     = $start->format('Y/m/d H:m:s');
        $std->end       = $end->format('Y/m/d H:m:s');

        if (isset($std->id) || !empty($std->id)) {
            ConsultaService::editar($std); 
        } else {
            ConsultaService::salvar($std);
                }
        $this->redirect(URL_BASE."consulta");
        } catch (Exception $e) {
            i($e->getMessage()); 
        }
     }
     public function excluir ($id_consulta) {
        ConsultaService::excluir($id_consulta); 
        $this->redirect(URL_BASE."consulta"); 
     }
    
    
   
    
}

