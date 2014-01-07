## ComproPago - PHP
Usa esta librería en PHP para conectarte al API de ComproPago.

## Uso
Configura un script como el siguiente y genera cargos de prueba o reales usando alguno de los API KEYs de tu cuenta de ComproPago.

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

## API
Para más información del uso del API consulta la <a href="https://compropago.com/documentacion/api">documentación</a>.

##Soporte
Si necesitas ayuda, abre un <a href="https://github.com/compropago/webhook-rails/issues">Issue en Github</a> o envíanos un email a <a href="mailto:soporte@compropago.com?Subject=Soporte" target="_top">soporte@compropago.com</a>, uno de nuestros expertos estará encantado de ayudarte.