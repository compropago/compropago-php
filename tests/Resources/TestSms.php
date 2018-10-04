<?php

namespace Tests\Resources\Payments;

use PHPUnit\Framework\TestCase;
use CompropagoSdk\Resources\Sms;
use CompropagoSdk\Resources\Payments\Cash;
use CompropagoSdk\Resources\Payments\Spei;

class TestSms extends TestCase
{
    const PUBLIC_KEY = 'pk_test_638e8b14112423a086';
    const PRIVATE_KEY = 'sk_test_9c95e149614142822f';

    /**
     * Test creation of object Sms
     *
     * @return Sms Instance of Sms object
     */
    public function testCreateObject()
    {
        try {
            $obj = (new Sms)->withKeys(self::PRIVATE_KEY, self::PUBLIC_KEY);
            $this->assertTrue($obj instanceof Sms);

            return $obj;
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
            return null;
        }
    }

    /**
     * Test send SMS for a cash order
     *
     * @depends testCreateObject
     *
     * @param Sms $obj Instance of Sms object
     */
    public function testSmsSendForCashOrders(Sms $obj)
    {
        try {
            $order = $this->createCashOrder();

            $sms = $obj->sendToOrder($order['id']);

            $this->assertEquals('sms.success', $sms['type']);
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
        }
    }

    /**
     * Test send SMS for a cash order
     *
     * @depends testCreateObject
     *
     * @param Sms $obj Instance of Sms object
     */
    public function testSmsSendForSpeiOrders(Sms $obj)
    {
        try {
            $order = $this->createSpeiOrder();

            $sms = $obj->sendToOrder($order['id']);

            $this->assertEquals('sms.success', $sms['type']);
        } catch (\Exception $e) {
            echo "{$e->getMessage()}\n";
            var_dump($e->getTrace());

            $this->assertTrue(false);
        }
    }

    /**
     * Create a cash order
     *
     * @return array
     */
    private function createCashOrder()
    {
        $cash = (new Cash)->withKeys(self::PRIVATE_KEY, self::PUBLIC_KEY);

        $data = [
            'order_id' => 2,
            'order_name' => 'Test order',
            'order_price' => 123.46,
            'customer_name' => 'Eduardo Aguilar',
            'customer_email' => 'devenv@compropago.com',
            'currency' => 'MXN',
            'payment_type' => 'OXXO',
            'image_url' => null
        ];

        return $obj->createOrder($data);
    }

    /**
     * Create a spei order
     *
     * @return array
     */
    private function createSpeiOrder()
    {
        $cash = (new Spei)->withKeys(self::PRIVATE_KEY, self::PUBLIC_KEY);

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

        return $obj->createOrder($data);
    }
}
