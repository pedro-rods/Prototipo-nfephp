<?php 
namespace app\models\Service;

use app\models\service\NotaFiscalService;
use app\models\service\XmlService;
use Exception;
use NFePHP\Common\Certificate;
use NFePHP\DA\NFe\Danfe;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;
use Psr\Log\InvalidArgumentException;
use NFePHP\NFe\Tools;

 

class NfeService {   

    public static function gerarxml($notafiscal) {
        $id_nfe = $notafiscal['nfe']->id_nfe; 
        $nfe = new \NFePHP\NFe\Make();  
        $std = new \stdClass();
        $std->versao = '4.00'; //versão do layout (string)
        $std->Id = ''; //se o Id de 44 digitos não for passado será gerado automaticamente
        $std->pk_nItem = null; //deixe essa variavel sempre como NULL
       
        $nfe->taginfNFe($std);  
        self::identificacao($nfe, $notafiscal['nfe']);
        self::emitente($nfe, $notafiscal['emitente']);
        self::destinatario($nfe, $notafiscal['destinatario']);
        $itens = $notafiscal['itens'];
        $cont = 0; 
        foreach ($itens as $item){ 
            $cont++;
            ItemNfeService::dadosProduto($cont, $nfe, $item);
            ItemNfeService::tagImposto($cont, $nfe, $notafiscal['nfe']);
            ItemNfeService::icmsSn($cont, $nfe);
            ItemNfeService::pis($cont, $nfe);
            ItemNfeService::cofins($cont, $nfe);              
        }    
        
        self::totais($nfe, $notafiscal['nfe']);  
        $std = new \stdClass();
        $std->modFrete = 0;
        $nfe->tagtransp($std);

        self::fatura($nfe, $notafiscal['nfe']);
        self::pagamento($nfe, $notafiscal['nfe']); 
        $retorno = new \stdClass();  

       try {
            $resultado = $nfe->montaNFe(); 
            if ($resultado) {
                //header("Content-type: text/xml; charset=UTF-8");
                $xml = $nfe->getXML();
                $chave = $nfe->getChave(); 
                $nomeXml = $chave.'-nfe.xml';
                $pastaAmbiente = ($notafiscal['nfe']->tpAmb == 1)? 'producao':'homologacao';
                $path = "Notas/{$pastaAmbiente}/entradas/{$nomeXml}";                
                file_put_contents($path, $xml); 
                chmod($path, 0777); 

                NotaFiscalService::salvarChave($id_nfe, $chave); 
                XmlService::salvar($id_nfe, $xml); 
                $retorno->erro = 1;
                $retorno->msg = "XML GERADO COM SUCESSO";
                $retorno->msgErro = ''; 
            } else {
                $retorno->erro = -1;
                $retorno->msg = "ERRO NA GERAÇÃO DE XML";
                $retorno->msgErro =  $nfe->getErrors(); 
            }
        } catch (Exception $e){
            i($nfe->getErrors());  
        }
       return $retorno; 
    }
    public static function assinarxml($notafiscal) {
        $arr = [
            "atualizacao" => "2023-07-20 09:11:21",
            "tpAmb" => 2,
            "razaosocial" => $notafiscal['emitente']->em_xNome,
            "cnpj" => deixaNumeros($notafiscal['emitente']->em_CNPJ),
            "siglaUF" => $notafiscal['emitente']->em_UF,
            "schemes" => "PL_009_V4",
            "versao" => '4.00',
            "tokenIBPT" => "",
            "CSC" => "",
            "CSCid" => "",
            "proxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]   
        ];
        
        
        $retorno = new \stdClass; 
        try {
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal['configuracao']->certificado_digital);
            $senha_certificado = $notafiscal['configuracao']->senha; 
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $senha_certificado));
            
            //Lendo o arquivo xml gerado
            $pastaAmbiente = ($notafiscal['nfe']->tpAmb == 1)? 'producao':'homologacao';
            $xml = "Notas/{$pastaAmbiente}/entradas/{$notafiscal['nfe']->chave}-nfe.xml";

            $response = $tools->signNFe(file_get_contents($xml));
            

            //Transportar o arquivo assinado para a pasta "Assinadas";
            $path_assinada = "Notas/{$pastaAmbiente}/assinadas/".$notafiscal['nfe']->chave."-nfe.xml";
            file_put_contents($path_assinada, $response); 
            chmod($path_assinada, 0777); 
            
            NotaFiscalService::mudarStatus($notafiscal['nfe']->id_nfe, 3); 

            $retorno->erro = -1;
            $retorno->msg = "XML ASSINADO COM SUCESSO";
            $retorno->msgErro = ''; 
           
        } catch (Exception $e) {
            $retorno->erro = 1;
            $retorno->msg = "ERRO NA ASSINATURA DO XML";
            $retorno->msgErro = $e->getMessage(); 
        }    
        return $retorno;  
    
    }
    public static function enviarxml($notafiscal) {
        $arr = [
            "atualizacao" => "2023-07-20 09:11:21",
            "tpAmb" => 2,
            "razaosocial" => $notafiscal['emitente']->em_xNome,
            "cnpj" => deixaNumeros($notafiscal['emitente']->em_CNPJ),
            "siglaUF" => "DF",
            "schemes" => "PL_009_V4",
            "versao" => '4.00',
            "tokenIBPT" => "",
            "CSC" => "",
            "CSCid" => "",
            "proxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass; 
        try {
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal['configuracao']->certificado_digital);
            $senha_certificado = $notafiscal['configuracao']->senha; 
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $senha_certificado));

            $idLote = str_pad($notafiscal['nfe']->nNF, 15, '0', STR_PAD_LEFT);

            //Lendo o arquivo XML que será enviado
            $pastaAmbiente = ($notafiscal['nfe']->tpAmb == 1)? 'producao':'homologacao';
            $xml = file_get_contents("Notas/{$pastaAmbiente}/assinadas/{$notafiscal['nfe']->chave}-nfe.xml");

            //envia o xml para pedir autorização ao SEFAZ
            $resp = $tools->sefazEnviaLote([$xml], $idLote);
            
            //transforma o xml de retorno em um stdClass
            $st = new Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                //erro registrar e voltar
                $retorno->erro = 1;
                $retorno->msg = "erro ao enviar XML";
                $retorno->msgErro = "[$std->cStat] $std->xMotivo"; 

                i($retorno);
            }
            $recibo = $std->infRec->nRec;
            
            NotaFiscalService::salvarRecibo($notafiscal['nfe']->id_nfe, $recibo); 

            $retorno->erro = -1;
            $retorno->msg = "XML ENVIADA COM SUCESSO";
            $retorno->msgErro = ''; 
            //esse recibo deve ser guardado para a proxima operação que é a consulta do recibo
            //header('Content-type: text/xml; charset=UTF-8');
            //echo $resp;
        } catch (Exception $e) {
            $retorno->erro = 1;
            $retorno->msg = "ERRO NA CONEXÃO";
            $retorno->msgErro = $e->getMessage(); 
        }
        return $retorno; 
    }

    public static function autorizarXml($notafiscal) {
        $arr = [
            "atualizacao" => "2023-07-20 09:11:21",
            "tpAmb" => 2,
            "razaosocial" => $notafiscal['emitente']->em_xNome,
            "cnpj" => deixaNumeros($notafiscal['emitente']->em_CNPJ),
            "siglaUF" => "DF",
            "schemes" => "PL_009_V4",
            "versao" => '4.00',
            "tokenIBPT" => "",
            "CSC" => "",
            "CSCid" => "",
            "proxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass(); 
        try {
            //$content = conteúdo do certificado PFX
            $configJson = json_encode($arr);
            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal['configuracao']->certificado_digital);
            $senha_certificado = $notafiscal['configuracao']->senha; 
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $senha_certificado));
            
            
            $numeroRecibo = $notafiscal['nfe']->recibo; 
            $tpAmb = 2;
            $xmlResp = $tools->sefazConsultaRecibo($numeroRecibo, $tpAmb);
            
            //transforma o xml de retorno em um stdClass
            $st = new Standardize();
            $std = $st->toStd($xmlResp);
        
            if ($std->cStat=='103') { //lote enviado
                //Lote ainda não foi processado pela SEFAZ;
                $retorno->erro = -1;
                $retorno->msg = "Lote ainda não processado";
                $retorno->msgErro = ""; 
            }
            if ($std->cStat=='105') { //lote em processamento
                //tente novamente mais tarde  
                $retorno->erro = -1;
                $retorno->msg = "Lote em processamento, tente novamente mais tarde";
                $retorno->msgErro = "";   
            }
            
            if ($std->cStat=='104') { //lote processado (tudo ok)
                if ($std->protNFe->infProt->cStat=='100') { //Autorizado o uso da NF-e                   
                    $protocolo = $std->protNFe->infProt->nProt;
                    $pastaAmbiente = ($notafiscal['nfe']->tpAmb == 1)? 'producao':'homologacao';
                    $xml_assinado = file_get_contents("Notas/{$pastaAmbiente}/assinadas/{$notafiscal['nfe']->chave}-nfe.xml");
        
                    // xml_assinado = xml original assinado
                    //xmlResp       = XML conteudo do retorno com a resposta da SEFAZ      
                    $xml_autorizado = Complements::toAuthorize($xml_assinado, $xmlResp);

                    //Transportar o arquivo autorizado para a pasta "autorizadas"
                    $path_autorizada = "Notas/{$pastaAmbiente}/autorizadas/".$notafiscal['nfe']->chave."-nfe.xml";
                    file_put_contents($path_autorizada, $xml_autorizado); 
                    chmod($path_autorizada, 0777); 

                    NotaFiscalService::salvarProtocolo($notafiscal['nfe']->id_nfe, $protocolo); 

                    $retorno->erro = -1;
                    $retorno->msg = "XML AUTORIZADO COM SUCESSO";
                    $retorno->msgErro = '';

                    return $retorno; 

                } elseif (in_array($std->protNFe->infProt->cStat,["110", "301", "302"])) { //DENEGADAS
                    $return = ["situacao"=>"denegada",
                               "numeroProtocolo"=>$std->protNFe->infProt->nProt,
                               "motivo"=>$std->protNFe->infProt->xMotivo,
                               "cstat"=>$std->protNFe->infProt->cStat,
                               "xmlProtocolo"=>$xmlResp];

                               $retorno->erro = 1;
                               $retorno->msg = "Nota Denegada";
                               $retorno->msgErro = $return['cstat'].":".$return['motivo']; 
                               return $retorno; 

                } else { //não autorizada (rejeição)
                    $return = ["situacao"=>"rejeitada",
                               "motivo"=>$std->protNFe->infProt->xMotivo,
                               "cstat"=>$std->protNFe->infProt->cStat];

                               $retorno->erro = 1;
                               $retorno->msg = "Nota rejeitada";
                               $retorno->msgErro = $return['cstat'].":".$return['motivo']; 
                               return $retorno; 
                }

            } else { //outros erros possíveis
                $return = ["situacao"=>"rejeitada",
                           "motivo"=>$std->xMotivo,
                           "cstat"=>$std->cStat];

                            $retorno->erro = 1;
                            $retorno->msg = "Nota rejeitada";
                            $retorno->msgErro = $return['cstat'].":".$return['motivo']; 
                            return $retorno; 
            } 
            
        } catch (Exception $e) {
            echo str_replace("\n", "<br/>", $e->getMessage());
        }
        
    }

    public static function danfe ($notafiscal) {
        $pastaAmbiente = ($notafiscal['nfe']->tpAmb == 1)? 'producao':'homologacao';
        $xml_autorizado = file_get_contents("Notas/{$pastaAmbiente}/autorizadas/{$notafiscal['nfe']->chave}-nfe.xml");

$logo = 'data://text/plain;base64,'. base64_encode(file_get_contents(realpath(__DIR__ . '/../images/tulipas.png')));
//$logo = realpath(__DIR__ . '/../images/tulipas.png');

try {

    $danfe = new Danfe($xml_autorizado);
    // $danfe->exibirTextoFatura = false;
    // $danfe->exibirPIS = false;
    // $danfe->exibirIcmsInterestadual = false;
    // $danfe->exibirValorTributos = false;
    // $danfe->descProdInfoComplemento = false;
    // $danfe->setOcultarUnidadeTributavel(true);
    // $danfe->obsContShow(false);
    // $danfe->printParameters(
    //     $orientacao = 'P',
    //     $papel = 'A4',
    //     $margSup = 2,
    //     $margEsq = 2
    // );
    // $danfe->logoParameters($logo, $logoAlign = 'C', $mode_bw = false);
    // $danfe->setDefaultFont($font = 'times');
    // $danfe->setDefaultDecimalPlaces(4);
    $danfe->debugMode(false);
    $danfe->creditsIntegratorFooter('WEBNFe Sistemas - http://www.webenf.com.br');
    //$danfe->epec('891180004131899', '14/08/2018 11:24:45'); //marca como autorizada por EPEC

    // Caso queira mudar a configuracao padrao de impressao
    /*  $this->printParameters( $orientacao = '', $papel = 'A4', $margSup = 2, $margEsq = 2 ); */
    // Caso queira sempre ocultar a unidade tributável
    /*  $this->setOcultarUnidadeTributavel(true); */
    //Informe o numero DPEC
    /*  $danfe->depecNumber('123456789'); */
    //Configura a posicao da logo
    /*  $danfe->logoParameters($logo, 'C', false);  */
    //Gera o PDF
    $pdf = $danfe->render();
    header('Content-Type: application/pdf');
    echo $pdf;
} catch (InvalidArgumentException $e) {
    echo "Ocorreu um erro durante o processamento :" . $e->getMessage();
}
    }

    public static function cancelaNfe($notafiscal) {
        $arr = [
            "atualizacao" => "2023-07-20 09:11:21",
            "tpAmb" => 2,
            "razaosocial" => $notafiscal['emitente']->em_xNome,
            "cnpj" => deixaNumeros($notafiscal['emitente']->em_CNPJ),
            "siglaUF" => "DF",
            "schemes" => "PL_009_V4",
            "versao" => '4.00',
            "tokenIBPT" => "",
            "CSC" => "",
            "CSCid" => "",
            "proxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass(); 
        try {
            //$content = conteúdo do certificado PFX
            $configJson = json_encode($arr);      

            $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal['configuracao']->certificado_digital);
            $senha_certificado = $notafiscal['configuracao']->senha; 
            $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $senha_certificado));
            
        
            $chave = $notafiscal['nfe']->chave;
            $xJust = 'Erro de digitação dos dados';
            $nProt = $notafiscal['nfe']->protocolo;
            $response = $tools->sefazCancela($chave, $xJust, $nProt);
        
            //você pode padronizar os dados de retorno atraves da classe abaixo
            //de forma a facilitar a extração dos dados do XML
            //NOTA: mas lembre-se que esse XML muitas vezes será necessário, 
            //      quando houver a necessidade de protocolos
            $stdCl = new Standardize($response);
            //nesse caso $std irá conter uma representação em stdClass do XML
            $std = $stdCl->toStd();
            //nesse caso o $arr irá conter uma representação em array do XML
            $arr = $stdCl->toArray();
            //nesse caso o $json irá conter uma representação em JSON do XML
            $json = $stdCl->toJson();
            
            //verifique se o evento foi processado
            if ($std->cStat != 128) {
                //houve alguma falha e o evento não foi processado
                //TRATAR
                $retorno->erro = 1;
                $retorno->msg = "Houve uma falha e a nota não pôde ser cancelada. ". $std->xMotivo;
                $retorno->msgErro = $std->cStat." : ".$std->xMotivo; 
                return $retorno; 
            } else {
                $cStat = $std->retEvento->infEvento->cStat;
                if ($cStat == '101' || $cStat == '135' || $cStat == '155') {
                    //SUCESSO PROTOCOLAR A SOLICITAÇÂO ANTES DE GUARDAR
                    $xml_cancelado = Complements::toAuthorize($tools->lastRequest, $response);
                    $pastaAmbiente = ($notafiscal['nfe']->tpAmb == 1)? 'producao':'homologacao';

                    //Transportar o arquivo autorizado para a pasta "canceladas"
                    $path_cancelada = "Notas/{$pastaAmbiente}/canceladas/".$notafiscal['nfe']->chave."-nfe.xml";
                    file_put_contents($path_cancelada, $xml_cancelado); 
                    chmod($path_cancelada, 0777); 

                    //Lendo o arquivo a ser enviado
                    $arquivo_aprovado = file_get_contents("Notas/{$pastaAmbiente}/autorizadas/{$notafiscal['nfe']->chave}-nfe.xml");
                    
                    $arquivo_aprovado_inalterado = file_get_contents("Notas/{$pastaAmbiente}/autorizadas/{$notafiscal['nfe']->chave}-nfe.xml");
                    
                    $xml_cancelamento = Complements::cancelRegister($arquivo_aprovado, $xml_cancelado);
                    chmod($arquivo_aprovado_inalterado, 0777); 
                    $retorno->erro = 1;
                    $retorno->msg = "Nota cancelada com sucesso";
                    $retorno->msgErro = ""; 

                    
                } else {
                    //houve alguma falha no evento 
                    //TRATAR
                }
            }    
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } 

    public static function consultaNfe ($notafiscal) {
        $arr = [
            "atualizacao" => "2023-07-20 09:11:21",
            "tpAmb" => 2,
            "razaosocial" => $notafiscal['emitente']->em_xNome,
            "cnpj" => deixaNumeros($notafiscal['emitente']->em_CNPJ),
            "siglaUF" => "DF",
            "schemes" => "PL_009_V4",
            "versao" => '4.00',
            "tokenIBPT" => "",
            "CSC" => "",
            "CSCid" => "",
            "proxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]   
        ];
        $retorno = new \stdClass(); 
        try{
             //$content = conteúdo do certificado PFX
             $configJson = json_encode($arr);      

             $certificado_digital = file_get_contents("Notas/certificados/".$notafiscal['configuracao']->certificado_digital);
             $senha_certificado = $notafiscal['configuracao']->senha; 
             $tools = new Tools($configJson, Certificate::readPfx($certificado_digital, $senha_certificado));
            
             $chave = $notafiscal['nfe']->chave; 
             $response = $tools->sefazConsultaChave($chave);

             $stdC1 = new Standardize($response);
             $std = $stdC1->toStd(); 

            i($std); 

    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

    public static function identificacao($nfe, $identificacao) {
        $std = new \stdClass();

        $std->cUF           = $identificacao->cUF;
        $std->cNF           = $identificacao->cNF;
        $std->natOp         = $identificacao->natOp;

        $std->indPag = 0; //NÃO EXISTE MAIS NA VERSÃO 4.00

        $std->mod           = $identificacao->modelo;
        $std->serie         = $identificacao->serie;
        $std->nNF           = $identificacao->id_nfe;
        $std->dhEmi         = $identificacao->dhEmi."-00:00"; // Os zeros são para correção de fusohorário, são obrigatórios 
        $std->dhSaiEnt      = $identificacao->dhEmi."-00:00";
        $std->tpNF          = $identificacao->tpNF;
        $std->idDest        = 1; // 1 = Opreação Interna , não mudar
        $std->cMunFG        = 5300108; // deve ter 7 dígitos
        $std->tpImp         = 1; // tipo de DANFE, 1 = normal
        $std->tpEmis        = 1; // tipo de Emissor, 1 = emissão normal 
        $std->cDV           = 2;
        $std->tpAmb         = 2;// 1 = Produção, 2 = Homologação(testes) 
        $std->finNFe        = 1; // 1 = Nfe Normal
        $std->indFinal      = 1; // 1 = Consumidor final 
        $std->indPres       = $identificacao->indPres;
        $std->indIntermed   = null;
        $std->procEmi       = 0; // emissor da nota, 0 = próprio contribuinte
        $std->verProc       = '3.10.31';
        $std->dhCont        = null;
        $std->xJust         = null;
       

        $nfe->tagide($std);
        
    }   

    public static function emitente ($nfe, $emitente) {
        $std = new \stdClass();
        $std->xNome     = tiraAcento($emitente->em_xNome);
        $std->xFant     = tiraAcento($emitente->em_xFant);
        $std->IE        = tira_mascara($emitente->em_IE);
        $std->IEST      = $emitente->em_IEST;
        $std->IM        = $emitente->em_IM;
        $std->CNAE      = $emitente->em_CNAE;
        $std->CRT       = $emitente->em_CRT;
        $std->CNPJ      = deixaNumeros($emitente->em_CNPJ); // ($emitente->em_CNPJ); //indicar apenas um CNPJ ou CPF
        $std->CPF       = null;

        $nfe->tagemit($std);

        $std            = new \stdClass();        
        $std->xLgr      = tiraAcento($emitente->em_xLgr);
        $std->nro       = $emitente->em_nro;
        $std->xCpl      = $emitente->em_xCpl;
        $std->xBairro   = tiraAcento($emitente->em_xBairro);
        $std->cMun      = '5300108'; // deve ter 7 dígitos
        $std->xMun      = 'Brasilia'; // deve ter 7 dígitos
        $std->UF        = 'DF';
        $std->CEP       = tira_mascara($emitente->em_CEP);
        $std->cPais     = 1058;
        $std->xPais     = "Brasil";
        $std->fone      = tira_mascara($emitente->em_fone);

        $nfe->tagenderEmit($std);       
        
    }
    public static function destinatario ($nfe, $destinatario) {
        $std                = new \stdClass();
        $std->xNome         = tiraAcento($destinatario->dest_xNome);
        $std->indIEDest     = 2;
        $std->IE            = null;
        //$std->ISUF          = 12345678;
        $std->IM            = $destinatario->dest_IM;
        $std->email         = $destinatario->dest_email;
      //$std->CNPJ          = $destinatario->dest_; //indicar apenas um CNPJ ou CPF ou idEstrangeiro
        $std->CPF           = tira_mascara($destinatario->dest_CPF);
      //$std->idEstrangeiro = $destinatario->dest_;

        $nfe->tagdest($std);

        $std                = new \stdClass();
        $std->xLgr          = tiraAcento($destinatario->dest_xLgr);
        $std->nro           = $destinatario->dest_nro;
        $std->xCpl          = $destinatario->dest_xCpl;
        $std->xBairro       = tiraAcento($destinatario->dest_xBairro);
        $std->cMun          = 5300108; // deve ter 7 dígitos
        $std->xMun          = tiraAcento($destinatario->dest_xMun); // deve ter 7 dígitos
        $std->UF            = $destinatario->dest_UF;
        $std->CEP           = tira_mascara($destinatario->dest_CEP);
        $std->cPais         = $destinatario->dest_cPais;
        $std->xPais         = $destinatario->dest_xPais;
        $std->fone          = tira_mascara($destinatario->dest_fone);

        $nfe->tagenderDest($std);
    }
    public static function totais($nfe, $notafiscal) {
        $std = new \stdClass();
            $std->vBC               = $notafiscal->vBC;
            $std->vICMS             = $notafiscal->vICMS; // 18%
            $std->vICMSDeson        = $notafiscal->vICMSDeson;
            $std->vBCST             = $notafiscal->vBCST;
            $std->vST               = $notafiscal->vST;
            $std->vProd             = $notafiscal->vProd;
            $std->vFrete            = $notafiscal->vFrete;
            $std->vSeg              = $notafiscal->vSeg;
            $std->vDesc             = $notafiscal->vDesc;
            $std->vII               = $notafiscal->vII;
            $std->vIPI              = $notafiscal->vIPI;
            $std->vPIS              = $notafiscal->vPIS;
            $std->vCOFINS           = $notafiscal->vCOFINS;
            $std->vOutro            = $notafiscal->vOutro;
            $std->vNF               = $notafiscal->vNF;
            $std->vIPIDevol         = $notafiscal->vIPIDevol;
            $std->vTotTrib          = $notafiscal->vTotTrib;
            $std->vFCP              = $notafiscal->vFCP;
            $std->vFCPST            = $notafiscal->vFCPST;
            $std->vFCPSTRet         = $notafiscal->vFCPSTRet;
            $std->vFCPUFDest        = null;       // $notafiscal->vFCPUFDest;
            $std->vICMSUFDest       = null;       // $notafiscal->vICMSUFDest;
            $std->vICMSUFRemet      = null;       // $notafiscal->vICMSUFRemet;
            $std->qBCMono           = null;       // $notafiscal->vBCMono;
            $std->vICMSMono         = null;       // $notafiscal->vICMSMono;
            $std->qBCMonoReten      = null;       // $notafiscal->vBCMonoReten;
            $std->vICMSMonoReten    = null;       // $notafiscal->vICMSMonoReten;
            $std->qBCMonoRet        = null;       // $notafiscal->vBCMonoReten;
            $std->vICMSMonoRet      = null;       // $notafiscal->vICMSMonoReten;

            $nfe->tagICMSTot($std);
    }

    public static function fatura ($nfe, $notafiscal) {
        $std = new \stdClass();
        $std->nFat  = $notafiscal->id_nfe;
        $std->vOrig = $notafiscal->vOrig;
        $std->vDesc = $notafiscal->vDesc;
        $std->vLiq  = $notafiscal->vLiq;

        $nfe->tagfat($std);
    }
    public static function pagamento($nfe, $notafiscal) {
        $std = new \stdClass();
        $std->vTroco = null; //incluso no layout 4.00, obrigatório informar para NFCe (65)
        $nfe->tagpag($std);

        $std = new \stdClass();
        $std->tPag          = '01';
        $std->vPag          = $notafiscal->vOrig; //Obs: deve ser informado o valor pago pelo cliente
        $std->CNPJ          = null ;
        $std->tBand         = null;
        $std->cAut          = null;
        $std->tpIntegra     = null; //incluso na NT 2015/002
        $std->indPag        = '0'; //0= Pagamento à Vista 1= Pagamento à Prazo

        $nfe->tagdetPag($std);
    }
}