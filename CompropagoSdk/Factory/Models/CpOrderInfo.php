<?php

namespace CompropagoSdk\Factory\Models;

class CpOrderInfo
{
    public $id;
    public $short_id;
    public $type;
    public $object;
    public $livemode;
    public $created_at;
    public $accepted_at;
    public $expires_at;
    public $paid;
    public $amount;
    public $currency;
    public $refunded;
    public $fee;
    public $fee_details;
    public $order_info;
    public $customer;
    public $api_version;

    public function __construct()
    {
        $this->fee_details = new FeeDetails();
        $this->order_info = new OrderInfo();
        $this->customer = new Customer();
    }
}