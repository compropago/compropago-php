<?php

namespace Tests\Resources\Payments;

use PHPUnit\Framework\TestCase;
use CompropagoSdk\Resources\Payments\Spei;

class TestSpei extends TestCase
{
    const PUBLIC_KEY = 'pk_test_638e8b14112423a086';
    const PRIVATE_KEY = 'sk_test_9c95e149614142822f';

    /**
     * Test creation of object Spei
     *
     * @return Spei Instance of Spei object
     */
    public function testCreateObject()
    {
        try {
            $obj = (new Spei)->withKeys(self::PRIVATE_KEY, self::PUBLIC_KEY);
            $this->assertTrue($obj instanceof Spei);

            return $obj;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
            return null;
        }
    }

    /**
     * Test spei order creation
     *
     * @depends testCreateObject
     *
     * @param Spei $obj Instance of Spei object
     *
     * @return array New Spei order
     */
    public function testCreateOrder(Spei $obj)
    {
        try {
            $data = [
                "product" => [
                    "id" => "12",
                    "price" => 123.45,
                    "name" => "test order spei",
                    "url" => "",
                    "currency" => "MXN"
                ],
                "customer" => [
                    "name" => "Eduardo Aguilar",
                    "email" => "devenv@compropago.com",
                    "phone" => ""
                ],
                "payment" =>  [
                    "type" => "SPEI"
                ]
            ];

            $order = $obj->createOrder($data);
            $this->assertTrue(!empty($order['id']));
            return $order;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
            return null;
        }
    }

    /**
     * Test spei order verification
     *
     * @depends testCreateObject
     * @depends testCreateOrder
     *
     * @param Spei $obj
     * @param array $order
     */
    public function testVerifyOrder(Spei $obj, $order)
    {
        try {
            $verified = $obj->veifyOrder($order['id']);

            $this->assertTrue($order['id'] === $verified['id']);
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
        }
    }
}
