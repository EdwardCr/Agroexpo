<? 

///////imprimir error
define("DEBUG", TRUE);

if(DEBUG)
{
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
$url="https://pgtest.redserfinsa.com:2027/WebPubTransactor/TransactorWS?WSDL";

$total_cart= number_format(10, 2, '.', ',');
$total_cart = (int)($total_cart * 100);
$total_cart = sprintf('%012d', $total_cart);

$security=(object)array(
	"comid"         => "SERVUNITYT",
	"comkey"        => '$erfins@',
	"comwrkstation" => "WORKSUNITYT"
);

$TXN="MANCOMPRANOR";
$expire_str = "2012";

$message =(object)array(
	"CLIENTE_TRANS_TARJETAMAN" => "9999994570392223",
	"CLIENTE_TRANS_MONTO"      =>$total_cart,
	"CLIENTE_TRANS_AUDITNO"    =>"1111127",
	"CLIENTE_TRANS_TARJETAVEN" =>$expire_str,
	"CLIENTE_TRANS_MODOENTRA"  =>"012",
	"CLIENTE_TRANS_TERMINALID" =>"00299997",
	"CLIENTE_TRANS_RETAILERID" =>"000999999999999",
	"CLIENTE_TRANS_RECIBOID"   =>"000027",
	"CLIENTE_TRANS_TOKENCVV"   =>"1611 333",
);

$xml =  "<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:web=\"http://webservices.serfinsa.sysdots.com/\">";
			$xml .= "<soapenv:Header/>";
			$xml .= "<soapenv:Body>";
			$xml .= "<web:cardtransaction>";
			$xml .= "         <!--Optional:-->";
			$xml .= "         <security>".json_encode($security)."</security>";
			$xml .= "         <!--Optional:-->";
			$xml .= "         <txn>".$TXN."</txn>";
			$xml .= "         <!--Optional:-->";
			$xml .= "         <message>".json_encode($message)."</message>";
			$xml .= "      </web:cardtransaction>";
			$xml .= "   </soapenv:Body>";
			$xml .= "</soapenv:Envelope>";


$headers = array(
		"Content-type: text/xml;charset=\"utf-8\"",
		"Accept: text/xml",
		"Cache-Control: no-cache",
		"Pragma: no-cache",
		"Content-length: ".strlen($xml),
	);

    // PHP cURL  for https connection with auth
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

	curl_setopt($ch, CURLOPT_SSLVERSION, 6);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // converting
	$response = curl_exec($ch); 

	var_dump($response);


?>