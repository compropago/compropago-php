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
 * Compropago
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */


namespace UnitTest;

require_once __DIR__ . "/../../../autoload.php";

use Compropago\Sdk\Client;
use Compropago\Sdk\Service;

class Test extends \PHPUnit_Framework_TestCase
{

    private $config = array(
        'publickey' => 'pk_test_5989d8209974e2d62',
        'privatekey' => 'sk_test_6ff4e982253c44c42',
        'live' => false
    );

    public function testClientService()
    {
        $client = null;
        try{
            $client = new Client($this->config);
        }catch(\Exception $e){
            echo "\n{$e->getMessage()}\n";
        }

        $this->assertTrue(!empty($client));

        return $client;
    }


    /**
     * @depends testClientService
     * @param Client $client
     * @return Service
     */
    public function testServiceService(Client $client)
    {
        $service = null;
        try{
            $service = new Service($client);
        }catch(\Exception $e){
            echo "\n{$e->getMessage()}\n";
        }

        $this->assertTrue(!empty($service));
        return $service;
    }

    /**
     * @depends testServiceService
     * @param Service $service
     */
    public function testServiceProviders(Service $service)
    {
        try{
            $res = $service->getProviders();
        }catch(\Exception $e){
            $res = array();
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(is_array($res) && !empty($res));
    }

    public function testServiceProvidersLimit()
    {
        $flag = true;
        $limit = 12000;
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->getProviders(false, $limit);

            foreach ($res as $provider){
                if($provider->transaction_limit < $limit){
                    $flag = false;
                    break;
                }
            }
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue($flag);
    }

    public function testServiceProvidersAuth()
    {
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->getProviders(true);
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(!empty($res));
    }

    public function testServiceProvidersAuthLimit()
    {
        $flag = true;
        $limit = 12000;
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->getProviders(true, $limit);

            foreach ($res as $provider){
                if($provider->transaction_limit < $limit){
                    $flag = false;
                    break;
                }
            }
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue($flag);
    }

    public function testProvidersAuthLimit()
    {
        $flag = true;
        $limit = 12000;
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->getProviders(true, $limit, true);

            foreach ($res as $provider){
                if($provider->transaction_limit < $limit){
                    $flag = false;
                    break;
                }
            }
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue($flag);
    }

    /**
     * @return mixed|null
     */
    public function testCreateWebhook()
    {
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->createWebhook("http://asd.com");
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(!empty($res));

        return $res;
    }

    /**
     * @depends testCreateWebhook
     * @param $data
     * @return mixed|null
     */
    public function testUpdateWebhook($data)
    {
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->updateWebhook($data->id,"prueba.com");
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(!empty($res));

        return $res;
    }

    /**
     * @depends testUpdateWebhook
     * @param $data
     */
    public function testDeleteWebhook($data)
    {
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->deleteWebhook($data->id);
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(!empty($res));
    }


    public function testGetWebhooks()
    {
        try{
            $client = new Client($this->config);
            $service = new Service($client);

            $res = $service->getWebhooks();
        }catch(\Exception $e){
            $res = null;
            echo "\n".$e->getMessage()."\n";
        }

        $this->assertTrue(!empty($res));
    }
}
