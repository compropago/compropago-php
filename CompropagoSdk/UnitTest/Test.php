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

namespace CompropagoSdk\UnitTest;

require_once __DIR__. "/../../../../autoload.php";

use CompropagoSdk\Client;
use CompropagoSdk\Factory\Abs\CpOrderInfo;
use CompropagoSdk\Factory\Abs\NewOrderInfo;
use CompropagoSdk\Factory\Abs\SmsInfo;
use CompropagoSdk\Models\PlaceOrderInfo;

class Test extends \PHPUnit_Framework_TestCase
{
    private $publickey = "pk_test_8781245a88240f9cf";
    private $privatekey = "sk_test_56e31883637446b1b";
    private $phonenumber = "5561463627";

    public function testCreateClient()
    {
        $client = null;
        try{
            $client = new Client(
                $this->publickey,
                $this->privatekey,
                false
            );
            $this->assertTrue(!empty($client));
        }catch(\Exception $e){
            $this->assertTrue(!empty($client));
            echo "\n".$e->getMessage()."\n";
        }

        return $client;
    }

    /**
     * @depends testCreateClient
     * @param Client $client
     * @return array
     */
    public function testServiceProviders(Client $client)
    {
        try{
            $res = $client->api->getProviders();
        }catch(\Exception $e){
            $res = array();
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(is_array($res) && !empty($res));

        return $res;
    }

    /**
     * @depends testServiceProviders
     * @param array $providers
     * @return array
     */
    public function testEmptyArrayProviders(array $providers)
    {
        $this->assertTrue(!empty($providers));
        return $providers;
    }

    /**
     * @depends testEmptyArrayProviders
     * @param array $providers
     */
    public function testTypeArrayProviders(array $providers)
    {
        $flag = true;
        foreach($providers as $key => $value){
            $flag = (get_class($value) == "CompropagoSdk\\Models\\Provider") ? $flag : false;
            if(!$flag)
                break;
        }

        $this->assertTrue($flag);
    }

    /**
     * @depends testCreateClient
     * @param Client $client
     * @return NewOrderInfo
     */
    public function testServicePlaceOrder(Client $client)
    {
        try{
            $order = new PlaceOrderInfo("11","M4 Style",1800,"Eduardo Aguilar","eduardo.aguilar@compropago.com");
            $res = $client->api->placeOrder($order);
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        

        $this->assertTrue(!empty($res));

        return $res;
    }

    /**
     * @depends testServicePlaceOrder
     * @param $neworder
     */
    public function testTypeServicePlaceOrder($neworder)
    {
        $this->assertTrue((get_parent_class($neworder) == "CompropagoSdk\\Factory\\Abs\\NewOrderInfo"));
    }

    /**
     * @depends testServicePlaceOrder
     * @param NewOrderInfo $order
     * @return CpOrderInfo
     */
    public function testServiceVerifyOrder(NewOrderInfo $order)
    {
        try {
            $client = new Client(
                $this->publickey,
                $this->privatekey,
                false
            );
            $res = $client->api->verifyOrder($order->getId());
        } catch (\Exception $e) {
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(!empty($res));
        return $res;
    }

    /**
     * @depends testServiceVerifyOrder
     * @param CpOrderInfo $order
     */
    public function testTypeServiceVerifyOrder(CpOrderInfo $order)
    {
        $this->assertTrue((get_parent_class($order) == "CompropagoSdk\\Factory\\Abs\\CpOrderInfo"));
    }

    /**
     * @depends testServicePlaceOrder
     * @param NewOrderInfo $order
     * @return SmsInfo
     */
    public function testServiceSms(NewOrderInfo $order)
    {
        try{
            $client = new Client(
                $this->publickey,
                $this->privatekey,
                false
            );

            $res = $client->api->sendSmsInstructions($this->phonenumber, $order->getId());
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(!empty($res));
        return $res;
    }

    /**
     * @depends testServiceSms
     * @param SmsInfo $info
     */
    public function testTypeServiceSms(SmsInfo $info)
    {
        $this->assertTrue((get_parent_class($info) == "CompropagoSdk\\Factory\\Abs\\SmsInfo"));
    }
}