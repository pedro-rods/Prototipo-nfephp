<?php 
namespace app\models\service;

class ItemNfeService {
    public static function dadosProduto($cont, $nfe, $item) {
        $std = new \stdClass();
        $std->item          = $cont; // Número do item na nota 
        $std->cProd         = $item->cProd;
        $std->cEAN          = $item->cEAN;
        $std->cBarra        = null;
        $std->xProd         = $item->xProd;
        $std->NCM           = $item->NCM;
        $std->cBenef        = $item->cBenef;
        $std->EXTIPI        = $item->EXTIPI;
        $std->CFOP          = $item->CFOP;
        $std->uCom          = $item->uCom;
        $std->qCom          = $item->qCom;
        $std->vUnCom        = $item->vUnCom;
        $std->vProd         = $item->vProd;
        $std->cEANTrib      = $item->cEANTrib;
        $std->cBarraTrib    = null;
        $std->uTrib         = $item->uTrib;
        $std->qTrib         = $item->qTrib;
        $std->vUnTrib       = $item->vUnTrib;
        $std->vFrete        = $item->vFrete;
        $std->vSeg          = $item->vSeg;
        $std->vDesc         = $item->vDesc;
        $std->vOutro        = $item->vOutro;
        $std->indTot        = $item->indTot;
        $std->xPed          = $item->xPed;
        $std->nItemPed      = $item->nItemPed;
        $std->nFCI          = null;
        
        $nfe->tagprod($std);
    }

    public static function tagImposto($cont, $nfe, $nota) {
        $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->vTotTrib = $nota->vTotTrib; 

        $nfe->tagimposto($std);
    }

    public static function icmsSn ($cont, $nfe) {
        $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->orig = 0;
        $std->CSOSN = '103'; // 103 deixa os outros campos desnecesssários, cuidado ao mudar
        /*
        $std->pCredSN = 2.00;
        $std->vCredICMSSN = 20.00;
        $std->modBCST = null;
        $std->pMVAST = null;
        $std->pRedBCST = null;
        $std->vBCST = null;
        $std->pICMSST = null;
        $std->vICMSST = null;
        $std->vBCFCPST = null; //incluso no layout 4.00
        $std->pFCPST = null; //incluso no layout 4.00
        $std->vFCPST = null; //incluso no layout 4.00
        $std->vBCSTRet = null;
        $std->pST = null;
        $std->vICMSSTRet = null;
        $std->vBCFCPSTRet = null; //incluso no layout 4.00
        $std->pFCPSTRet = null; //incluso no layout 4.00
        $std->vFCPSTRet = null; //incluso no layout 4.00
        $std->modBC = null;
        $std->vBC = null;
        $std->pRedBC = null;
        $std->pICMS = null;
        $std->vICMS = null;
        $std->pRedBCEfet = null;
        $std->vBCEfet = null;
        $std->pICMSEfet = null;
        $std->vICMSEfet = null;
        $std->vICMSSubstituto = null; */

        $nfe->tagICMSSN($std);
    }

   public static function pis($cont, $nfe) {
        $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->CST = '07';
        $std->vBC = null;
        $std->pPIS = null;
        $std->vPIS = null;
        $std->qBCProd = null;
        $std->vAliqProd = null;

        $nfe->tagPIS($std);
   }

   public static function cofins($cont, $nfe) {
    $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->CST = '07';
        $std->vBC = null;
        $std->pCOFINS = null;
        $std->vCOFINS = null;
        $std->qBCProd = null;
        $std->vAliqProd = null;

        $nfe->tagCOFINS($std);
   }

   public static function issqn($cont, $nfe) { // imposto saobre serviços 
    $std = new \stdClass();
        $std->item = $cont; //item da NFe
        $std->vBC = 1000.00;
        $std->vAliq = 5.00;
        $std->vISSQN = 50.00;
        $std->cMunFG = '3518800';
        $std->cListServ = '12.23';
        $std->vDeducao = null;
        $std->vOutro = null;
        $std->vDescIncond = null;
        $std->vDescCond = null;
        $std->vISSRet = null;
        $std->indISS = 2;
        $std->cServico = '123';
        $std->cMun = '3518800';
        $std->cPais = '1058';
        $std->nProcesso = null;
        $std->indIncentivo = 2;

        $nfe->tagISSQN($std);
   }
}