<?php
	require_once("libraries/compropago.class.php");
	$key = 'API_KEY';
	$comproPago = new ComproPago($key); 
	$request = array(
        'currency' => 'MXN',
        'order_price' => '2799.00',
        'order_name' => 'Samsung Galaxy',
        'order_id'=> 'SAMGAL7A',
        'image_url'=> '',
        'customer_name'=> 'Federico Garcia',
        'customer_email'=> 'email@gmail.com',
        'customer_phone'=> '5555555555',
        'payment_type'=> 'WALMART',
        'send_sms'=> false
    );
	$response = $comproPago->requestPayment($request);
	print_r($response);
?>