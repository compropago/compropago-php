<?php
/************************************************************
 *	
 *	@Edited by: Rodrigo Ayala 
 *	@Edited at: 2-Oct-2013
 *	@Created by: Amir Canto / http://www.twitter.com/amircp
 *	@Created at: September 19, 2013.
 *  
*************************************************************/

class ComproPago{
	private $_apiKey = '';

	function __construct($key=''){
		$this->_apiKey = $key;
	}

	public function setAccessToken($key){
		$this->_apiKey = $key;
	}
	
	public function requestData($postData){
		if(empty($this->_apiKey)) return 0;
		// Cabeceras HTTP
		$headers = array('Accept: application/compropago+json',
						 'Content-type: application/json'
					);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERPWD, $this->_apiKey.":");
		curl_setopt($ch, CURLOPT_URL, "http://api.compropago.com/v1/charges");			 // URL API 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // Cabeceras API
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // No verificamos certificado SSL (no body cares).
		curl_setopt($ch, CURLOPT_POST, 1);				 // Peticiones POST
 		curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);	 // Mandamos el Json
 		curl_setopt($ch, CURLOPT_HEADER,0);  			 //Retornar cabeceras 
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER  ,1);    //Retornar datos de llamada
		$respuesta = curl_exec($ch);					
		return $respuesta;
	}

	public function requestPayment($data){
		if(is_array($data)){	
			$data = json_encode($data);
			$response = $this->requestData($data);
			return json_decode($response);
		}
	}
}
?>