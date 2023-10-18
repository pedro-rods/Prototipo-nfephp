<?php 
namespace app\models\service;

use app\controllers\ItemnotafiscalController;
use app\models\dao\NotaFiscalDao; 


class NotaFiscalService {
   

    public static function getNotaFiscal($id_nfe) {
        $dao = new NotaFiscalDao(); 
        return $dao->getNotaFiscal($id_nfe); 
    }


    public static function salvarNota($id_venda) {
        // $configuracao   = Service::get("configuracao", "id_configuracao", 1); 
         $venda          = Service::get("venda", "id_venda", $id_venda); 
         $empresa        = Service::get("emitente", "id_emitente", 2);
         $estado         = Service::get("estado", "uf_estado", $empresa->uf);
         $cliente        = Service::get("cliente", "id_cliente", $venda->id_cliente); 
         $itens          = ItemVendaService::listaPorVenda($id_venda);   
         
         $nota = new \stdClass();
     $nota->id_venda = $id_venda;
     $nota->cUF = 53;
     $nota->cNF = '80070008';
     $nota->natOp = 'VENDA';
 
     $nota->indPag = 0; //NÃO EXISTE MAIS NA VERSÃO 4.00
 
     $nota->modelo = 55;
     $nota->serie = 1;
     $nota->nNF = 2; // = $nconfiguracao->ultimaNFe + 1 // as nfes seguem um padrao de fila 
     $nota->dhEmi = hoje().'T'.agora();
     $nota->dhSaiEnt = null;
     $nota->tpNF = 1;
     $nota->idDest = 1;
     $nota->cMunFG = $empresa->ibge;
     $nota->tpImp = 1;
     $nota->tpEmis = 1;
     $nota->cDV = 2;
     $nota->tpAmb = 2; // NAO MUDAR, aqui diz que o ambiente é de homologacao, vulgo campo de testes
     $nota->finNFe = 1;
     $nota->indFinal = 1;
     $nota->indPres = 1;
     # campo obrigatório apenas caso o campo $nota->indPres seja diferente de 1
 
     $nota->procEmi = 0;
     $nota->verProc = '3.10.31';
     $nota->dhCont = null;
     $nota->xJust = null;
 
     $nfe = Service::get('nfe', 'id_venda', $id_venda); 
     if(!$nfe) {
         $nota->id_status = 2;
         $id_nfe = Service::inserir(objToArray($nota), 'nfe');
     } else {
         if($nfe->id_status < 7) {
         $nota->id_status = 2;
         Service::editar(objToArray($nota), 'id_nfe', 'nfe'); 
         } else {
             return $nfe->id_nfe;
         }
         $id_nfe = $nfe->id_nfe;
     }
     
     if(!$id_nfe) { echo 'Erro'; exit;}
 
         $emitente = new \stdClass; 
         $emitente->id_nfe       = $id_nfe;
         $emitente->em_xNome     = tiraAcento($empresa->razao_social);
         $emitente->em_xFant     = tiraAcento($empresa->nome_fantasia);
         $emitente->em_IE        = $empresa->ie;
         $emitente->em_IEST      = $empresa->iest;
         $emitente->em_IM        = $empresa->im;
         $emitente->em_CNAE      = $empresa->cnae;
         $emitente->em_CRT       = $empresa->regime_tributario;
         $emitente->em_CNPJ      = tira_mascara($empresa->cnpj); 
 
         $emitente->em_xLgr      = tiraAcento($empresa->logradouro);
         $emitente->em_nro       = $empresa->numero;
         $emitente->em_xCpl      = tiraAcento($empresa->complemento);
         $emitente->em_xBairro   = tiraAcento($empresa->bairro);
         $emitente->em_cMun      = tira_mascara($empresa->ibge);
         $emitente->em_xMun      = tiraAcento($empresa->cidade);
         $emitente->em_UF        = $empresa->uf;
         $emitente->em_CEP       = $empresa->cep;
         $emitente->em_cPais     = 1058;
         $emitente->em_xPais     = 'Brasil';
         $emitente->em_fone      = tira_mascara($empresa->fone);
         $emitente->ultima_atualizacao = $empresa->ultima_atualizacao;
 
         $emit = Service::get('nfe_emitente','id_nfe', $id_nfe); 
         if (!$emit) {
             Service::inserir(objToArray($emitente), 'nfe_emitente');
         } else {
             Service::editar(objToArray($emitente), 'id_nfe', 'nfe_emitente'); 
         }
         
         $dest = new \stdClass();
         $dest->id_nfe                = $id_nfe;
         $dest->dest_xNome            = tiraAcento($cliente->nome);
         $dest->dest_indIEDest        = $cliente->indIEDest;
         $dest->dest_IE               = $cliente->ie;              
         $dest->dest_ISUF             = $cliente->suframa;
         $dest->dest_IM               = $cliente->im;
         $dest->dest_email            = $cliente->email;
         $dest->dest_CNPJ             = $cliente->cnpj; 
         $dest->dest_CPF              = $cliente->cpf;
 
         $dest->dest_xLgr             = tiraAcento($cliente->logradouro);
         $dest->dest_nro              = $cliente->numero;
         $dest->dest_xCpl             = tiraAcento($cliente->complemento);
         $dest->dest_xBairro          = tiraAcento($cliente->bairro);
         $dest->dest_cMun             = tira_mascara($cliente->ibge); // Código do município
         $dest->dest_xMun             = tiraAcento($cliente->cidade);
         $dest->dest_UF               = $cliente->uf;
         $dest->dest_CEP              = $cliente->cep;
         $dest->dest_cPais            = '1058';
         $dest->dest_xPais            = 'Brasil';
         $dest->dest_fone             = $cliente->fone;
 
         $d = Service::get('nfe_destinatario', 'id_nfe', $id_nfe);
         if(!$d) {
             Service::inserir(objToArray($dest), 'nfe_destinatario'); 
         } else {
             $dest->dest_id_destinatario = $d->id_destinatario;
             Service::editar(objToArray($dest), 'id_destinatario','nfe_destinatario');
         }
 
         //Listando os itens 
         $j = 1; 
         $total = 0;
         foreach ($itens as $i) {
             $item = new \stdClass();
             $item->id_nfe           = $id_nfe; 
             $item->numero_item      = $j++; //item da NFe
             $item->id_produto       =  $i->id_produto;
             $item->cProd            = $i->id_produto;
             $item->cEAN             = $i->gtin;
             $item->xProd            = tiraAcento($i->produto);
             $item->NCM              = $i->ncm;
 
             $item->cBenef           = $i->cbenef;
 
             $item->EXTIPI           = $i->extipi;
             $item->CFOP             = $i->cfop;
             $item->uCom             = $i->abrev;
             $item->qCom             = $i->qtde;
             $item->vUnCom           = $i->valor;
             $item->vProd            = $item->vUnCom * $item->qCom ;
             $item->cEANTrib         = $i->gtin;
             $item->uTrib            = $i->abrev;
             $item->qTrib            = $i->qtde;
             $item->vUnTrib          = $i->valor;
             $item->vFrete           = null;
             $item->vSeg             = null;
             $item->vDesc            = null;
             $item->vOutro           = null;
             $item->indTot           = 1;
             $item->xPed             = $id_nfe;
             $item->nItemPed         = $item->numero_item;
             $item->nFCI             = $i->nfci;    
             
             $total                  += $item->vProd;
 
             $it = ItemnotafiscalController::existeItem($id_nfe, $i->id_produto) ;
             if(!$it) {
                 Service::inserir(objToArray($item), 'nfe_item');
             } else {
                 $item->id_nfe_item = $it->id_nfe_item;
                 Service::editar(objToArray($item), 'id_nfe_item', 'nfe_item'); 
                 
             }
         }
 
         Service::editar(['id_nfe' => $id_nfe, 'vOrig' => $total, 'Vliq' => $total,  'vProd' => $total,  'vNF' => $total], 'id_nfe', 'nfe');
         

        }  

        public static function lista() {
            $dao = new NotaFiscalDao(); 
            return $dao->lista(); 
        }

        public static function salvarChave($id_nfe, $chave) {
            $dao = new NotaFiscalDao();
            return $dao->salvarChave($id_nfe, $chave); 
        }
        public static function mudarStatus($id_nfe, $status) {
            $dao = new NotaFiscalDao();
            return $dao->mudarStatus($id_nfe, $status); 
        }
        public static function salvarRecibo($id_nfe, $recibo) {
            $dao = new NotaFiscalDao();
            return $dao->salvarRecibo($id_nfe, $recibo); 
        }
        public static function salvarProtocolo($id_nfe, $protocolo) {
            $dao = new NotaFiscalDao();
            return $dao->salvarProtocolo($id_nfe, $protocolo); 
        }
}