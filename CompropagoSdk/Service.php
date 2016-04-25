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

class Service
{
    private $auth;
    private $fullAuth;

    private $uri;

    public function __construct(Client $client)
    {
        $this->auth = $client->getAuth();
        $this->fullAuth = $client->getFullAuth();
        $this->uri = $client->getUri();
    }


    public function getProviders()
    {
        try{
            $response = Rest::get($this->uri."providers/true/",$this->auth);
            $providers = Factory::arrayProviders($response);

            return $providers;
        }catch(\Exception $e){
            throw new CpException($e->getMessage(),$e->getCode(), $e);
        }
    }

    public function verifyOrder( $orderId )
    {

    }

    public function placeOrder()
    {

    }

    public function sendSmsInstructions($number,$orderId)
    {

    }
}