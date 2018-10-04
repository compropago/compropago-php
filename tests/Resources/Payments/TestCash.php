<?php

namespace Tests\Resources\Payments;

use PHPUnit\Framework\TestCase;
use CompropagoSdk\Resources\Payments\Cash;

class TestCash extends TestCase
{
    const PUBLIC_KEY = 'pk_test_638e8b14112423a086';
    const PRIVATE_KEY = 'sk_test_9c95e149614142822f';

    /**
     * Test Cash object generation
     *
     * @return Cash
     */
    public function testCreateObject()
    {
        try {
            $obj = (new Cash)->withkeys(self::PRIVATE_KEY, self::PUBLIC_KEY);
            $this->assertTrue($obj instanceof Cash);

            return $obj;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
            return null;
        }
    }

    /**
     * Test if list default providers is a valid array
     *
     * @depends testCreateObject
     *
     * @param Cash $obj Instance of Cash object
     */
    public function testListdefaultProviders(Cash $obj)
    {
        try {
            $providers = $obj->listDefaultProviders();
            $this->assertTrue(is_array($providers));
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
        }
    }

    /**
     * Test if the list of providers for a store is a valid array
     *
     * @depends testCreateObject
     *
     * @param Cash $obj Instance of Cash object
     */
    public function testListProviders(Cash $obj)
    {
        try {
            $providers = $obj->listProviders();
            $this->assertTrue(is_array($providers));
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
        }
    }

    /**
     * Test order creation for cash payment method
     *
     * @depends testCreateObject
     *
     * @param Cash $obj Instance of Cash object
     */
    public function testCreateOrder(Cash $obj)
    {
        try {
            $data = [
                'order_id' => 1,
                'order_name' => 'Test order',
                'order_price' => 123.45,
                'customer_name' => 'Eduardo Aguilar',
                'customer_email' => 'devenv@compropago.com',
                'currency' => 'MXN',
                'payment_type' => 'OXXO',
                'image_url' => null
            ];

            $order = $obj->createOrder($data);

            $this->assertTrue(is_array($order));

            return $order;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);

            return null;
        }
    }

    /**
     * Test order verification
     *
     * @depends testCreateObject
     * @depends testCreateOrder
     *
     * @param Cash  $obj   Instance of Cash object
     * @param array $order Order array
     */
    public function testVerifyOrder(Cash $obj, $order)
    {
        try {
            $verified = $obj->verifyOrder($order['id']);

            $this->assertTrue($order['id'] === $verified['id']);
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
        }
    }
}
