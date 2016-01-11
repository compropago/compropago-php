<?php
/*
* Copyright 2016 Compropago.
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
 * @since 1.0.2
 * @author Rolando Lucio <rolando@compropago.com>
 */
namespace Compropago\Utils;



use Compropago\Client;
use Compropago\Exception;
use Compropago\Service;

class Store{
	/**
	 * Validate if config params allow transactions
	 * @return bool
	 * @param Client $Client
	 * @since 1.0.2
	 */
	public static function validateGateway(Client $Client){
		if(!isset($Client)){
			return false;
		}
		$moduleLive=$Client->getMode();
		try{
		    //lets make new service
			$compropagoService = new Service($Client);
			if(!$compropagoResponse = $compropagoService->evalAuth()){
				//not proper keys?
				return false;
			}
			if($compropagoResponse->mode_key != $compropagoResponse->livemode){
				//compropagoKey vs compropago Mode
				return false;
			}
			if($moduleLive != $compropagoResponse->livemode){
				// store Mode vs compropago Mode
				return false;
			}
			if($moduleLive != $compropagoResponse->mode_key){
				// store Mode vs compropago Keys
				return false;
			}
		}catch (Exception $e) {
			//should rethrow?
			//echo  $e->getMessage();
			return false;
		}	
		// Ok Move on
		return true;
	}
}