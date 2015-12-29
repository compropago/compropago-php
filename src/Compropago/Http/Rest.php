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
* @author Rolando Lucio <rolando@compropago.com>
*/

namespace Compropago\Http;

use Compropago\Http\Curl;
use Compropago\Http\Request;
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
		$http=$client->getHttp();
$http=new Request($url);
		$http->setServiceUrl($service);
		$http->setRequestMethod($method);
		if($method!='GET' || $method!='POST'){
			//no more in rest 
			
		}
		if($query && $method=='POST'){
			//just post data
			$http->setData($query);
			$http->evalData();
		}
		
		$curl= new Curl();
		
		
		$res = $client->request($method,$service,$requestParams);
		return $res;		
	}
}