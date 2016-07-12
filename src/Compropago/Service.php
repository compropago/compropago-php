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
 * @since 1.0.1
 * @author Rolando Lucio <rolando@compropago.com>
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */

namespace Compropago\Sdk;

use Compropago\Sdk\Http\Rest;
use Compropago\Sdk\Utils\Utils;
use Compropago\Sdk\Exceptions\HttpException;


class Service
{
    /**
     * @var Client client
     */
    private $client;

    /**
     * Service constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client=$client;
    }


    /**
     * Valida las llaves
     *
     * @return mixed|void
     * @throws Exceptions\BaseException
     * @throws HttpException
     */
    public function evalAuth()
    {
        $response=Rest::doExecute($this->client,'users/auth');

        //Error Mng Imp Test
        $httpCode=$response['responseCode'];
        switch ($httpCode){
            case '401':
                throw new HttpException($httpCode, "Error Processing Request");
                return;
                break;

            case '500':
                throw new HttpException($httpCode, "Error Processing ComproPago");
                return;
                break;

            case '200':
                return json_decode($response['responseBody']);
                break;

            default:
                $error = 'ComproPago Unexpected http code error';
                throw new HttpException($httpCode, $error);
                return;
        }
    }

    /**
     * Get to pay providers
     *
     * @param bool $auth
     * @param int $limit
     * @param bool $fetch
     * @return mixed
     * @throws Exceptions\BaseException
     */
    public function getProviders($auth = false, $limit = 0, $fetch = false)
    {
        $uri = $auth ? "providers" : "providers/true";

        if(is_numeric($limit) && $limit > 0){
            $uri .= "?order_total=$limit";
        }

        if(is_bool($fetch) && $fetch){
            if(is_numeric($limit) && $limit > 0){
                $uri .= "&fetch=true";
            }else{
                $uri .= "?fetch=true";
            }
        }

        $response=Rest::doExecute($this->client, $uri);
        $jsonObj= json_decode($response['responseBody']);

        return $jsonObj;
    }

    /**
     * Verify order Id status
     *
     * @param string $orderId
     * @return mixed
     * @since 1.0.1
     */
    public function verifyOrder( $orderId )
    {
        $response=Rest::doExecute($this->client,'charges/'.$orderId);
        $jsonObj= json_decode($response['responseBody']);

        //normalize to latest api version structure if charge response
        if($jsonObj->api_version=='1.0' &&  isset($jsonObj->data->object->id) &&  !empty($jsonObj->data->object->id))
            $jsonObj= Utils::normalizeResponse($jsonObj);

        return $jsonObj;
    }


    /**
     * Genera una orden de compra
     *
     * @param $params
     * @return mixed|object
     * @throws Exceptions\BaseException
     */
    public function placeOrder( $params )
    {
        $response=Rest::doExecute($this->client,'charges/',$params,'POST');
        $jsonObj= json_decode($response['responseBody']);

        //normalize to latest api version structure if charge was created
        if($jsonObj->api_version=='1.0' && $jsonObj->payment_status=='PENDING')
            $jsonObj= Utils::normalizeResponse($jsonObj);

        return $jsonObj;
    }


    /**
     * Envia un SMS con las instrucciones de pago
     *
     * @param $phoneNumber
     * @param $orderId
     * @return mixed
     * @throws Exceptions\BaseException
     */
    public function sendSmsInstructions($phoneNumber, $orderId)
    {
        $params = array(
            "customer_phone" => $phoneNumber
        );

        $response = Rest::doExecute($this->client,'charges/'.$orderId.'/sms/',$params,'POST');
        $jsonObj = json_decode($response['responseBody']);

        return $jsonObj;
    }

}