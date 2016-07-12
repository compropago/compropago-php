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

namespace SdkUnittest;

use Compropago\Sdk\Client;
use Compropago\Sdk\Service;

class Test extends \PHPUnit_Framework_TestCase
{
    private $config = array(
        "publickey" => "pk_test_8781245a88240f9cf",
        "privatekey" => "sk_test_56e31883637446b1b",
        "live" => false
    );

    private $phonenumber = "5561463627";
    private $service = null;
    
    public function testCreateClient()
    {
        $client = null;
        try{
            $client = new Client($this->config);
            $this->assertTrue(!empty($client));
        }catch(\Exception $e){
            $this->assertTrue(false);
            echo "\n".$e->getMessage()."\n";
        }

        return $client;
    }

    /**
     * @depends testCreateClient
     * @param Client $client
     */
    public function testCreateService(Client $client)
    {
        try{
            $this->service = new Service($client);
            $this->assertTrue(!empty($this->service));
        }catch(\Exception $e){
            $this->assertTrue(false);
            echo "\n".$e->getMessage()."\n";
        }
    }
}
