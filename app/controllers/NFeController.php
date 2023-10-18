<?php
namespace app\controllers;

use app\core\Controller;
use app\models\service\NfeService;
use app\models\service\NotaFiscalService;

class NfeController extends Controller{

    public function getNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        i($notafiscal);
    }
    public function gerarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        $xml = NfeService::gerarxml($notafiscal); 
        i($xml); 
    }

    public function assinarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        $xml = NfeService::assinarxml($notafiscal); 
        i($xml);
    }
    public function enviarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        $xml = NfeService::enviarxml($notafiscal); 
        i($xml);
    }
    public function autorizarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        $xml = NfeService::autorizarXml($notafiscal); 
        i($xml);
    }    
    public function danfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        NfeService::danfe($notafiscal);         
    }
    public function cancelarNfe($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        $xml = NfeService::cancelaNfe($notafiscal); 
        i($xml);
    }
    public function consultaNfe ($id_nfe){
        $notafiscal = NotaFiscalService::getNotaFiscal($id_nfe); 
        NfeService::consultaNfe($notafiscal); 
    }
                                                                                                                                                           
    
}