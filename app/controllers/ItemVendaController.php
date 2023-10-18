<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\ItemVendaService;
use app\models\service\Service;
use app\models\service\VendaService;

class ItemVendaController extends Controller{
   private $tabela = "item_venda";
   private $campo  = "id_item_venda";   
    
   
    public function salvar () {
        $item_venda = new \stdClass();
        $item_venda->id_item_venda  = ($_POST['id_item_venda']) ? $_POST['id_item_venda'] : null;
        $item_venda->id_produto     = $_POST['id_produto']; 
        $item_venda->id_venda       = $_POST['id_venda']; 
        $item_venda->qtde           = $_POST['qtde']; 
        $item_venda->valor          = $_POST['valor']; 
        $item_venda->subtotal       = ($_POST['qtde'] * $_POST['valor']); 
        
        
           
        Service::inserir(objToArray($item_venda), $this->tabela); 
        VendaService::atualizarVenda($item_venda->id_venda);
        $this->redirect(URL_BASE."venda/edit/". $item_venda->id_venda); 
          
        
    }

    public function excluir($id){
        $item_venda = Service::get('item_venda', 'id_item_venda',$id);        
        Service::excluir($this->tabela, $this->campo, $id);
        VendaService::atualizarVenda($item_venda->id_venda);
        $this->redirect(URL_BASE."venda/edit/". $item_venda->id_venda); 
    }
    
}

