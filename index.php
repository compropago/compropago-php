<?php
	require_once("libraries/compropago.class.php");
	$key = 'API_KEY';
	$comproPago = new ComproPago($key); 
	$request = array(
        'currency' => 'MXN',
        'product_price' => '2799.00',
        'product_name' => 'Samsung Galaxy',
        'product_id'=> 'SAMGAL7A',
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