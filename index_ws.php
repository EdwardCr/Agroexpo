
<?php
	//// datos encriptados
 
	 error_reporting(E_ALL); 
	 ini_set('display_errors', 1); 
	 /** * este metodo permite encriptar informacion * @param string $data, informacion a encriptar * @param string $secrect_key, llave secretada que permite desencriptar la informacion */ 
	 function encrypt($data, $secret_key) 
	 { 
	  $encrypted_text = ""; 
	  $plaintext = $data; 
	  $cipher = "aes-256-cbc"; 
	  $ivstr = "fedcba9876543210"; 
	  if (in_array($cipher, openssl_get_cipher_methods())) 
	  { 
	 $encrypted_text = openssl_encrypt($plaintext, $cipher, $secret_key, false, $ivstr); 
	  }
	  return 		  
	 $encrypted_text; 
	 } 
	  $secret_key = "TABSHrIfZBcH0hJpx0RbWJN1C2DU2r0PsDE+4n6my6tTgG+wIcn32/UFUk8kGARsK85Sc1icdTYSEc/xbc9ghg=="; 
	
	// echo "https://www.makepixels.com/ :: Encriptado(". encrypt("https://www.makepixels.com/", $secret_key)
	 //////url de retorno cuando a pagado.
	 $url_back_ok_post= encrypt("https://makepixels.com/cuzca/datos/", $secret_key).")";
	 $monto_transicion= encrypt("36.58", $secret_key).")";
	 $url_back_denied_post= encrypt("https://makepixels.com/cuzca/error/", $secret_key).")";
     $numero_de_tarjeta= encrypt("4111111111111111", $secret_key).")";
     $cvv2= encrypt("123", $secret_key).")";
     $pedido=time();
?>
<?php
define("DEBUG", TRUE);

if(DEBUG)
{
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}

$wsdl = 'https://test.payway.sv/web-payway-sv/services/paywayone/WSPayWayOne?wsdl'; //URL de nuestro servicio soap

//Basados en la estructura del servicio armamos un array
$params = Array(
   
	"token"=> "oKTQDWLszQP9E/M4duNIboT1B/54ZqB07tIV+4JdcIsTX0uULYRsSzQcNmB5KuJLgRx8iQyVoJyA81kyZYnG5A==",
	"idColector"=> '1000',
	"ipCliente"=> "127.0.0.1",
	"usuarioCliente"=> "make5000",
	"usuarioCorreo"=> "info@makepixels.com",
	"datosUsuarioInterno"=>array( "usuarioPlataforma"=>"MAKE.PIXELS.PAGO" ),
	////datos tarjeta 

"datosServicio"=>array
	(
	"monto"=> '$monto_transicion',
	"conceptoPago"=>"Pedido 25417"
),


"datosMedioPago"=>array( "principal"=>array
	(
	"nombreTarjetahabiente"=>"JOSE MARIO ALONZO",
	"fechaExpiracion"=>"202012",
	"numeroTarjeta"=> '$numero_de_tarjeta',	
    "cvv2"=>'$cvv2'
)),

	
	"datosAuxiliares"=>array(
	"datoAuxiliar1"=>"11111",
    "datoAuxiliar2"=>"22222",
	"datoAuxiliar3"=>"33333",
	"datoAuxiliar4"=>"44444",
							 ),
	
    );

$options = Array(
	"uri"=> $wsdl,
	"style"=> SOAP_RPC,
	"use"=> SOAP_ENCODED,
	"soap_version"=> SOAP_1_1,
	"cache_wsdl"=> WSDL_CACHE_BOTH,
	"connection_timeout" => 15,
	"trace" => false,
	"encoding" => "UTF-8",
	"exceptions" => false,
	);

//Enviamos el Request
$soap = new SoapClient($wsdl, $options);


$result = $soap->realizarPago(json_encode($params)); //Aquí cambiamos dependiendo de la acción del servicio que necesitemos ejecutar
var_dump($result);