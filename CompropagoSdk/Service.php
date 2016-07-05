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

use CompropagoSdk\Factory\Factory;
use CompropagoSdk\Models\PlaceOrderInfo;
use CompropagoSdk\Tools\Rest;
use CompropagoSdk\Tools\Validations;

/**
 * Class Service Provee de los servicios necesarios para el manejo de la API de ComproPago
 * @package CompropagoSdk
 */
class Service
{
    private $client;
    private $headers;
    
    /**
     * Service constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->headers = array(
            'useragent: '.$client->getContained()
        );
    }

    /**
     * Retorna un arreglo con los proveedores disponibles ordenados por Rank
     *
     * @return array
     * @throws \Exception
     */
    public function getProviders($auth = false, $limit = 0, $fetch = false)
    {
        try{

            if($auth){
                $uri = $this->client->getUri()."providers";
                $keys = $this->client->getFullAuth();
            }else{
                $uri = $this->client->getUri()."providers/true";
                $keys = "";
            }

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

            $response = Rest::get($uri,$keys,$this->headers);
            $providers = Factory::arrayProviders($response);

            return $providers;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(),$e->getCode(), $e);
        }
    }

    /**
     * @param $orderId
     * @return Factory\Abs\CpOrderInfo
     * @throws \Exception
     */
    public function verifyOrder( $orderId )
    {
        try{
            Validations::validateGateway($this->client);

            $response = Rest::get($this->client->getUri()."charges/$orderId/",$this->client->getAuth(),$this->headers);
            $obj = Factory::cpOrderInfo($response);

            return $obj;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(),$e->getCode(), $e);
        }
    }

    /**
     * @param PlaceOrderInfo $neworder
     * @return Factory\Abs\NewOrderInfo
     * @throws \Exception
     */
    public function placeOrder(PlaceOrderInfo $neworder)
    {
        try{
            Validations::validateGateway($this->client);

            $params = "order_id=".$neworder->order_id.
                "&order_name=".$neworder->order_name.
                "&order_price=".$neworder->order_price.
                "&customer_name=".$neworder->customer_name.
                "&customer_email=".$neworder->customer_email.
                "&payment_type=".$neworder->payment_type.
                "&image_url=".$neworder->image_url;

            $response = Rest::post($this->client->getUri()."charges/",$this->client->getAuth(),$params,$this->headers);
            $obj = Factory::newOrderInfo($response);

            return $obj;

        }catch(\Exception $e){
            throw new \Exception($e->getMessage(),$e->getCode(), $e);
        }
    }

    /**
     * @param $number
     * @param $orderId
     * @return Factory\Abs\SmsInfo
     * @throws \Exception
     */
    public function sendSmsInstructions($number,$orderId)
    {
        try{
            Validations::validateGateway($this->client);

            $params = "customer_phone=".$number;

            $response= Rest::post($this->client->getUri()."charges/".$orderId."/sms/",$this->client->getAuth(),$params,
                $this->headers);
            $obj = Factory::smsInfo($response);

            return $obj;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(),$e->getCode(), $e);
        }
    }

    /**
     * @param $url
     * @return Models\Webhook
     * @throws \Exception
     */
    public function createWebhook($url)
    {
        try{
            Validations::validateGateway($this->client);
            
            $params = "url=".$url;
            
            $response = Rest::post($this->client->getUri()."webhooks/stores/", $this->client->getFullAuth(), $params,
                $this->headers);
            $obj = Factory::webhook($response);

            return $obj;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getWebhooks()
    {
        try{
            Validations::validateGateway($this->client);
            
            $response = Rest::get($this->client->getUri()."webhooks/stores/",$this->client->getFullAuth(),
                $this->headers);
            $obj = Factory::listWebhooks($response);
            
            return $obj;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $webhookId
     * @param $url
     * @return Models\Webhook
     * @throws \Exception
     */
    public function updateWebhook($webhookId, $url)
    {
        try{
            Validations::validateGateway($this->client);
            
            $params = "url=".$url;
            
            $response = Rest::put($this->client->getUri()."webhooks/stores/$webhookId/",
                $this->client->getFullAuth(), $params,$this->headers);

            $obj = Factory::webhook($response);
            
            return $obj;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $webhookId
     * @return Models\Webhook
     * @throws \Exception
     */
    public function deleteWebhook($webhookId)
    {
        try{
            Validations::validateGateway($this->client);

            $response=Rest::delete($this->client->getUri()."webhooks/stores/$webhookId/", $this->client->getFullAuth(),
                null,$this->headers);
            $obj = Factory::webhook($response);
            
            return $obj;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), $e->getCode(), $e);
        }
    }
}