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


namespace CompropagoSdk;


use CompropagoSdk\Exceptions\CpException;
use CompropagoSdk\Factory\Factory;
use CompropagoSdk\Tools\Rest;
use CompropagoSdk\Tools\Validations;


/**
 * Class Service Provee de los servicios necesarios para el manejo de la API de ComproPago
 * @package CompropagoSdk
 */
class Service
{
    private $client;

    /**
     * Service constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retorna un arreglo con los proveedores disponibles ordenados por Rank
     *
     * @return array
     * @throws CpException
     */
    public function getProviders()
    {
        try{
            $response = Rest::get($this->client->getUri()."providers/true/","");
            $providers = Factory::arrayProviders($response);

            return $providers;
        }catch(\Exception $e){
            throw new CpException($e->getMessage(),$e->getCode(), $e);
        }
    }

    public function verifyOrder( $orderId )
    {
        try{
            Validations::validateGateway($this->client);

            $response = Rest::get($this->client->getUri()."charges/$orderId/",$this->client->getAuth());
            $obj = Factory::cpOrderInfo($response);

            return $obj;
        }catch(\Exception $e){
            throw new CpException($e->getMessage(),$e->getCode(), $e);
        }
    }

    public function placeOrder()
    {
        try{

        }catch(\Exception $e){
            throw new CpException($e->getMessage(),$e->getCode(), $e);
        }
    }

    public function sendSmsInstructions($number,$orderId)
    {
        try{

        }catch(\Exception $e){
            throw new CpException($e->getMessage(),$e->getCode(), $e);
        }
    }
}