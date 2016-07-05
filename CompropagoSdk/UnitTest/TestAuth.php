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
 * Compropago $Library
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */


namespace CompropagoSdk\UnitTest;

require_once __DIR__. "/../../../../autoload.php";

use CompropagoSdk\Client;
use CompropagoSdk\Tools\Validations;
use CompropagoSdk\Models\PlaceOrderInfo;

class TestAuth extends \PHPUnit_Framework_TestCase
{
    private $publickey = "pk_test_8781245a88240f9cf";
    private $privatekey = "sk_test_56e31883637446b1b";
    private $mode = false;

    public function testEvalAuth()
    {
        try{
            $client = new Client(
                $this->publickey,
                $this->privatekey,
                $this->mode
            );

            $val = Validations::evalAuth($client);
            echo "\$$val";
        }catch(\Exception $e){
            echo "\n{$e->getMessage()}\n";
        }

        $this->assertTrue(isset($val) && !empty($val));
        return $client;
    }

    /**
     * @depends testEvalAuth
     * @param Client $client
     * @return NewOrderInfo
     */
    public function testServicePlaceOrder(Client $client)
    {
        try{
            $order = new PlaceOrderInfo("12","M4 Style",180,"Eduardo Aguilar","eduardo.aguilar@compropago.com");
            $res = $client->api->placeOrder($order);
        }catch(\Exception $e){
            $res = null;
            echo "\n{$e->getMessage()}\n";
        }

        $this->assertTrue(!empty($res));

        return $res;
    }
}
