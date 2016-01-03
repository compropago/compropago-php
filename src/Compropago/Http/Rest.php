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
* Versión para compatibilidad con php 5.3 +
* @since 1.0.1
* @author Rolando Lucio <rolando@compropago.com>
*/

namespace Compropago\Http;

use Compropago\Http\Curl;

use Compropago\Client;
use Compropago\Exception;



class Rest{
	
/**
 * 
 * @param array $auth
 * @param Compropago\Client $client
 * @param string $service
 * @param string $query
 * @param string $method
 * @returns Array
 */
	public static function doExecute(Client $client,$service=null,$query=FALSE,$method='GET') {
		if(!isset($client)){
			throw new Exception('Client Required');
		}
		
		$request= $client->getHttp();
		switch ($method){
			
			case 'GET':
			case 'POST':
				//supp rest methods
				$request->setRequestMethod($method);
			break;
			default:
			//no more in rest 
			throw new Exception('Rest Method not supported');
		}

		$request->setServiceUrl($service);
		
		
		if($query && $method=='POST'){
			//just post data, throw con query en GET?
			$request->setData($query);
		}
		
		$request->setMethodOptions($method);
		//$request->setOptions($addopts);
		
		$curl= new Curl();
		
		
		$response = $curl->executeRequest($request);
		
		//eval aca, errors parse data, http codes fatal exceptions,etc
		
		return $response['responseBody'];
	}
}