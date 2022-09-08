<?php
/*
class BaseSoap
{
	protected static $options;
	protected static $context;
	protected static $wsdl;

	public function __construct() {
	}

	public static function setWsdl($service) {
		return self::$wsdl = $service;
	}

	public static function getWsdl(){
		return self::$wsdl;
	}

	protected static function generateContext(){
		self::$options = [
		'http' => [
		'user_agent' => 'PHPSoapClient'
		]
		];
		return self::$context = stream_context_create(self::$options);
	}

	static function formatNumber($amount){
		$clean=number_format($amount, 2, '', ' ');
		return str_pad($clean,  12, "0",STR_PAD_LEFT);
	}

	public function loadXmlStringAsArray($xmlString)
	{
		$array = (array) @simplexml_load_string($xmlString);
		if(!$array){
			$array = (array) @json_decode($xmlString, true);
		} else{
			$array = (array)@json_decode(json_encode($array), true);
		}
		return $array;
	}
}
class InstanceSoapClient extends BaseSoap
{
	public static function init(){
		$wsdlUrl = self::getWsdl();
		$soapClientOptions = [
		'stream_context' => stream_context_create([
			'http' => [
			'user_agent' => 'PHPSoapClient'
			]
		]),
		'cache_wsdl'     => WSDL_CACHE_NONE,
		'encoding' => 'UTF-8',
		'verifypeer' => false,
		'verifyhost' => false,
		'keep_alive'=>false,
		'trace' => true
		];
		return new SoapClient(, $soapClientOptions);
	}
}*/

		$soapClientOptions = [
		'stream_context' => stream_context_create([
			'http' => [
			'user_agent' => 'PHPSoapClient'
			]
		]),
		'cache_wsdl'     => WSDL_CACHE_NONE,
		'encoding' => 'UTF-8',
		'verifypeer' => false,
		'verifyhost' => false,
		'keep_alive'=>false,
		'trace' => true
		];
         $wsdlUrl='https://test.payway.sv/web-payway-sv/services/paywayone/WSPayWayOne?wsdl';
          $soap = new SoapClient($wsdlUrl, $soapClientOptions);
		print_r($soap->__getTypes());
//           print_r($service->__getTypes());
