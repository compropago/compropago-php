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


class ProvidersTest extends \PHPUnit_Framework_TestCase
{
    private $publickey = "pk_test_8781245a88240f9cf";
    private $privatekey = "sk_test_56e31883637446b1b";
    private $mode = false;

    public function testCreateClient()
    {
        $client = null;
        try{
            $client = new Client(
                $this->publickey,
                $this->privatekey,
                $this->mode
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
     * @depends testCreateClient
     * @param Client $client
     */
    public function testServiceProvidersLimit(Client $client)
    {
        try{
            $res = $client->api->getProviders(false, 15000);

            $flag = true;
            foreach ($res as $provider){
                if($provider->transaction_limit < 15000){
                    $flag = false;
                    break;
                }
            }
        }catch(\Exception $e){
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(isset($flag) && $flag);
    }

    /**
     * @depends testCreateClient
     * @param Client $client
     */
    public function testServiceProviderAuth(Client $client)
    {
        try{
            $res = $client->api->getProviders(true);

            if($res){
                $res = $client->api->getProviders(true);
            }
        }catch(\Exception $e){
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(isset($res) && is_array($res) && !empty($res));
    }


    /**
     * @depends testCreateClient
     * @param Client $client
     */
    public function testServiceProviderAuthLimit(Client $client)
    {
        try{
            $res = $client->api->getProviders(true, 15000);

            $flag = true;
            foreach ($res as $provider){
                if($provider->transaction_limit < 15000){
                    $flag = false;
                    break;
                }
            }
        }catch(\Exception $e){
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(isset($flag) && $flag);
    }

    /**
     * @depends testCreateClient
     * @param Client $client
     */
    public function testServiceProvidersAuthFetch(Client $client)
    {
        try{
            $res = $client->api->getProviders(true, 15000, true);

            $flag = true;
            foreach ($res as $provider){
                if($provider->transaction_limit < 15000){
                    $flag = false;
                    break;
                }
            }
        }catch(\Exception $e){
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(isset($flag) && $flag);
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
}
