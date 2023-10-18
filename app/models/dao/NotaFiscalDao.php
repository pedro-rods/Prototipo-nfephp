<?php 
namespace app\models\dao; 
use app\core\Model;
use app\models\service\Service;

class NotaFiscalDao extends Model {
    public function lista() {
        $sql = "SELECT * FROM nfe n, nfe_destinatario d WHERE n.id_nfe = d.id_nfe;"; 
        return $this->select($this->db, $sql, true); 
    }

   
    
    public function getNotaFiscal($id_nfe) {

       
        $nfe = Service::get('nfe', 'id_nfe', $id_nfe);

        
        $dest = Service::get('nfe_destinatario', 'id_nfe', $id_nfe);

        
        $itens = Service::get('nfe_item', 'id_nfe', $id_nfe, true);

        
        $emitente = Service::get('nfe_emitente', 'id_nfe', $id_nfe);

        $config = Service::get('configuracao', 'id_configuracao', 1); 

        $array =[
            "nfe"           =>$nfe, 
            "destinatario"  => $dest,
            "emitente"      => $emitente,
            "itens"         => $itens,
            "configuracao"  => $config
        ]; 
       
        return $array; 
    }

    public function salvarChave($id_nfe, $chave) {
        $sql = "UPDATE nfe SET chave = '$chave', id_status = 9 WHERE nfe.id_nfe = $id_nfe"; 
        return $this->db->query($sql);
    }
    public function mudarStatus($id_nfe, $status) {
        $sql = "UPDATE nfe SET id_status = '$status' WHERE nfe.id_nfe = $id_nfe"; 
        return $this->db->query($sql);
    }
    public function salvarRecibo($id_nfe, $recibo) {
        $sql = "UPDATE nfe SET recibo = '$recibo', id_status = 4 WHERE nfe.id_nfe = $id_nfe"; 
        return $this->db->query($sql);
    }
    public function salvarProtocolo($id_nfe, $protocolo) {
        $sql = "UPDATE nfe SET protocolo = '$protocolo', id_status = 5 WHERE nfe.id_nfe = $id_nfe"; 
        return $this->db->query($sql);
    }
   
}