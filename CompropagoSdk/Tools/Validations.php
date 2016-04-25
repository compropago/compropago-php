<?php
/**
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
 * Compropago php-sdk
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */


namespace CompropagoSdk\Tools;


use CompropagoSdk\Client;
use CompropagoSdk\Exceptions\CpException;
use CompropagoSdk\Exceptions\HttpException;
use CompropagoSdk\Factory\Factory;

class Validations
{

    public static function evalAuth( Client $client )
    {
        try{
            $response = Rest::get($client->getUri()."users/auth/", $client->getFullAuth());
            $info = Factory::evalAuthInfo($response);

            switch($info->getCode()){
                case '401':
                    throw new CpException("CODE 401: ".$info->getMessage(),401);
                    break;
                case '500':
                    throw new CpException("CODE 500: ".$info->getMessage(),500);
                    break;
                case '200':
                    return $info;
                default:
                    throw new HttpException("CODE {$info->getCode()}: ".$info->getMessage(),$info->getCode());
            }
        }catch(\Exception $e){
            throw new HttpException($e->getMessage(),$e->getCode());
        }
    }

    public static function validateGateway( Client $client )
    {
        if(empty($client)){
            throw new CpException("El objecto Client no es valido");
        }

        $clientMode = $client->getMode();

        try{
            $authinfo = self::evalAuth($client);

            if($authinfo->getModeKey() != $authinfo->getLiveMode()){
                throw new CpException("Las llaves no corresponden a modo de la tienda");
            }

            if($clientMode != $authinfo->getLiveMode()){
                throw new CpException("El modo del cliente no corresponde al de la tienda");
            }

            if($clientMode != $authinfo->getModeKey()){
                throw new CpException("El modo del cliente no corresponde al de las llaves");
            }
        }catch(\Exception $e){
            throw new CpException($e->getMessage(),$e->getCode(),$e);
        }

        return true;
    }

}