<?php


$xml='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:web="http://webservices.serfinsa.sysdots.com/">
   <soapenv:Header/>
   <soapenv:Body>
      <web:cardtransaction>
         <!--Optional:-->
         <security>{"comid":"SERVUNITYT","comkey":"$erfins@","comwrkstation":"WORKSUNITYT"}</security>
         <!--Optional:-->
         <txn>MANCOMPRANOR</txn>
         <!--Optional:-->
         <message>
      {"CLIENTE_TRANS_TARJETAMAN":"9999994570392223",
      "CLIENTE_TRANS_MONTO":"000000000027",
      "CLIENTE_TRANS_AUDITNO":"111127",
      "CLIENTE_TRANS_TARJETAVEN":"2012",
      "CLIENTE_TRANS_MODOENTRA":"012",
      "CLIENTE_TRANS_TERMINALID":"00299997",
      "CLIENTE_TRANS_RETAILERID":"000999999999999",
      "CLIENTE_TRANS_RECIBOID":"000027",
      "CLIENTE_TRANS_TOKENCVV":"1611 333"}
     </message>
      </web:cardtransaction>
   </soapenv:Body>
</soapenv:Envelope>';
$curl = curl_init();
  $headers = array(
    "Content-type: text/xml;charset=\"utf-8\"",
    "Accept: text/xml",
    "Cache-Control: no-cache",
    "Pragma: no-cache",
    "Content-length: ".strlen($xml),
  );
  curl_setopt($curl, CURLOPT_URL, "https://pgtest.redserfinsa.com:2027/WebPubTransactor/TransactorWS?WSDL");
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);


  curl_setopt($curl, CURLOPT_TIMEOUT, 30);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

  curl_setopt($curl, CURLOPT_SSLVERSION, 6);
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);


$response = curl_exec($curl);


  try{
    if (empty($response)) {
      if(curl_errno($curl)=="28"){
        $timeout = true;
        return false;
      }
      throw new SoapFault('CURL error: '.curl_error($curl),curl_errno($curl));
    }
    curl_close($curl);
    $_response = simplexml_load_string($response);
echo $response;
    $result = @json_decode($_response->children('S', true)->Body->children('ns2', true)->cardtransactionResponse->children()->return);

    if(isset($result->cliente_trans_respuesta)){
      return $result;
    }
    return false;
    

  }catch(SoapFault $e){
    $soap_error=$e;
    echo $soap_error;
    return false;
  }

