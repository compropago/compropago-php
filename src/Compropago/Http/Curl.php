<?php
/*
* Copyright 2015 Compropago.
*
* Licensed under the Apache License, Version 2.0 (the "License");
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
*     http://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an "AS IS" BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/

/**
 * cUrl implementation of Compropago API
 *
 * @author Rolando Lucio <rolando@compropago.com>
 */
 
namespace Compropago\Http;

use Compropago\Client;
use Compropago\Exception;
use Compropago\Http\Request;


class Curl{
	/**
	 * @throws Compropago\Exception en error de librerias 
	 */
	//Singleton Curl or Client, or not?
	public function __construct(){
		if (!extension_loaded('curl') || !function_exists('curl_init')) {
			$error="Compropago no se puede ejecutar: se requiere la extensión Curl en el servidor";
			throw new Exception($error);
		}
	}
	
	/**
	 * @param Compropago\Request $request objeto con los parametros validados de una petición
	 * @return array [headers,body,httpCode] 
	 */
	public function executeRequest(Request $request){
		$curl = curl_init();
		if ($request->getPostBody()) {
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request->getPostBody());
		}
		$requestHeaders = $request->getRequestHeaders();
		if ($requestHeaders && is_array($requestHeaders)) {
			$curlHeaders = array();
			foreach ($requestHeaders as $k => $v) {
				$curlHeaders[] = "$k: $v";
			}
			curl_setopt($curl, CURLOPT_HTTPHEADER, $curlHeaders);
		}
		curl_setopt($curl, CURLOPT_URL, $request->getUrl());
		
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $request->getRequestMethod());
		curl_setopt($curl, CURLOPT_USERAGENT, $request->getUserAgent());
		
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, true);
		
		
	
		
		foreach ($request->getOptions as $key => $var) {
			curl_setopt($curl, $key, $var);
		}
		
		if (!isset($this->options[CURLOPT_CAINFO])) {
			curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacerts.pem');
		}
		/*
		 * 	if ($errorCode == 60 || $errorCode == 77) {
				curl_setopt($curl, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
				$rbody = curl_exec($curl);
			}
		 */
	
		$response = curl_exec($curl);
		if ($response === false) {
			$error = curl_error($curl);
			$code = curl_errno($curl);
			
			throw new Exception($error, $code);
		}
		$headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
		
		list($responseHeaders, $responseBody) = $this->parseHttpResponse($response, $headerSize);
		
		$responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		
		return array($responseBody, $responseHeaders, $responseCode);
	}
	 
}
?>