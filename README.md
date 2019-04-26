ComproPago API - PHP SDK
========================

[![Build Status](https://travis-ci.org/danteay/compropago-php.svg?branch=master)](https://travis-ci.org/danteay/compropago-php)

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/8d7881ac258ce680ffea#?env%5BComproPago%20API%5D=W3siZW5hYmxlZCI6dHJ1ZSwiZGVzY3JpcHRpb24iOnsiY29udGVudCI6IiIsInR5cGUiOiJ0ZXh0L3BsYWluIn0sInZhbHVlIjoiaHR0cHM6Ly9hcGkuY29tcHJvcGFnby5jb20iLCJrZXkiOiJob3N0In0seyJlbmFibGVkIjp0cnVlLCJkZXNjcmlwdGlvbiI6eyJjb250ZW50IjoiIiwidHlwZSI6InRleHQvcGxhaW4ifSwidmFsdWUiOiIiLCJrZXkiOiJwdWJsaWNfa2V5In0seyJlbmFibGVkIjp0cnVlLCJkZXNjcmlwdGlvbiI6eyJjb250ZW50IjoiIiwidHlwZSI6InRleHQvcGxhaW4ifSwidmFsdWUiOiIiLCJrZXkiOiJwcml2YXRlX2tleSJ9XQ==)

Introducción
============
Con ComproPago puede recibir pagos vía SPEI y en efectivo.

La librería de `ComproPago PHP SDK` le permite interactuar con el API de ComproPago en su aplicación.
También cuenta con los métodos necesarios para facilitarle su desarrollo por medio de los servicios
más utilizados.

Índice de contenidos
--------------------
- [Ayuda y soporte de ComproPago](#ayuda-y-soporte-de-compropago)
- [Requerimientos](#requerimientos)
- [Instalación](#instalación)
- [Guía básica de uso](#guía-básica-de-uso)
- [Métodos base del SDK](#métodos-base-del-sdk)
- [Enviar instrucciones por SMS](#enviar-instrucciones-por-sms)
- [Webhooks](#webhooks)

Ayuda y soporte de ComproPago
=============================
Puede obtener información acerca de nuestros servicios en alguno de los siguientes enlaces:
- [Centro de ayuda y soporte](https://compropago.com/ayuda-y-soporte)
- [Solicitar integración](https://compropago.com/integracion)
- [Guía para empezar a usar ComproPago](https://compropago.com/ayuda-y-soporte/como-comenzar-a-usar-compropago)
- [Información de contacto](https://compropago.com/contacto)

En caso de tener alguna pregunta o requerir el apoyo técnico, por favor contacte al correo: soporte@compropago.com y proporcionando la siguiente información:

- Nombre completo del propietario de la cuenta.
- URL del sitio web de la tienda.
- Teléfono local o celular.
- Correo electrónico del propietario de la cuenta.
- Texto detallado de la duda o requerimiento.
- En caso de presentar algún problema técnico, por favor enviar capturas de pantalla o evidencia para una respuesta más efectiva.

Requerimientos
==============

- [PHP >= 5.6](http://www.php.net/)
- [Composer](https://getcomposer.org/)
- [PHP cURL extension](http://php.net/manual/en/book.curl.php)
- [PHP JSON extension](http://php.net/manual/en/book.json.php)

Instalación
===========

## Instalación por Composer

Puede descargar el SDK directamente desde el repositorio de **Composer** con el siguiente comando:

```bash
composer require compropago/php-sdk && composer -o dumpautoload
```

O si lo prefiere, puede incluir directamente en su archivo `composer.json` el siguiente código:

```json
{
    "require" : {
        "compropago/php-sdk": "*"
    }
}
```

Posteriormente deberá instalar las dependencias usando el siguiente comando:
```bash
composer install
```

## Instalación por Github
Puede descargar alguna de las versiones que hemos publicado aquí:
- [Versiones publicadas en GitHub](https://github.com/compropago/compropago-php/releases)

O si lo desea puede clonar nuestro repositorio de la siguiente forma:

```bash
# Repositorio en su estado actual (Puede ser una versión inestable)
git clone https://github.com/compropago/compropago-php.git
```

Guía básica de uso
==================

Se debe contar con una cuenta activa de ComproPago.
- [Registrarse en ComproPago](https://panel.compropago.com/users/sign_up)
- [Documentación detallada del SDK](http://demo.compropago.com/sdk/php)

Importación
-----------
```php
<?php

require 'vendor/autoload.php';

# Importar objeto Spei
use CompropagoSdk\Resources\Payments\Spei;

# Importar objeto Cash
use CompropagoSdk\Resources\Payments\Cash;
```

Uso básico de la libreria
-------------------------
Para poder hacer uso del SDK y procesar las llamadas al API, es necesario que
configurar sus llaves de conexión y crear un instancia de Cash o Spei.
Sus llaves las encontrara en su Panel de ComproPago en el menú Configuración.

- [Consultar llaves de ComproPago](https://panel.compropago.com/panel/configuracion)

Instacia de objecto **Spei** para cobros mediante transferencia
```php
<?php

/**
 * Configuración de las llaves de ComproPago
 * 
 * @param string $public   Llave pública correspondiente al modo de la tienda
 * @param string $private  Llave privada correspondiente al modo de la tienda
 */
$compropagoSpei = (new Spei)->withKeys(
    'pk_test_xxxxxxxxxxxxxxxxxx',
    'sk_test_xxxxxxxxxxxxxxxxxx'
);

```

Instacia de objecto **Cash** para cobros en efectivo
```php
<?php

/**
 * Configuración de las llaves de ComproPago
 * 
 * @param string $public   Llave pública correspondiente al modo de la tienda
 * @param string $private  Llave privada correspondiente al modo de la tienda
 */
$compropagoCash = (new Cash)->withKeys(
    'pk_test_xxxxxxxxxxxxxxxxxx',
    'sk_test_xxxxxxxxxxxxxxxxxx'
);

```


Métodos base del SDK
====================

Ordenes de pago mediante trasferencia (SPEI)
--------------------------------------------

### Crear una nueva orden de pago
```php
<?php
# Información de la orden
$data = [
    "product" => [
        "id" => "10001",
        "price" => 258.99,
        "name" => "Test ComproPago SPEI",
        "currency" => "MXN",
        "url" => "http://dummyurl.com/prod10001.jpg"
    ],
    "customer" => [
        "id" => "123454",
        "name" => "Nombre del Cliente",
        "email" => "cliente@dominio.com",
        "phone" => "55222999888"
    ],
    "payment" =>  [
        "type" => "SPEI"
    ],
    "expiresAt" => 1556555092
];

/**
 * Creación de orden para cobro mediante trasnferencia (SPEI) por medio de ComproPago
 * 
 * @param array $data   Información de la orden
 * @return array        Estructura con información de la orden generada en SPEI
 */
$order = $compropagoSpei->createOrder($data);
```

### Verificar el estatus de la orden
```php
<?php

/**
 * Verificar la información de una orden SPEI
 * 
 * @param string $orderId   ID de la orden generada por medio de SPEI
 * @return array            Estructura con información de la orden generada en SPEI
 */
$verified = $compropagoSpei->verifyOrder($order['data']['id']);
```

Ordenes de pago en efectivo
---------------------------

### Listar proveedores para pago en efectivo
```php
<?php

/**
 * Listar proveedores para pago en efectivo disponibles para su tienda
 * 
 * @param float  $limit     Monto límite que el proveedor puede que aceptar
 * @param string $currency  Moneda para el monto límite
 */
$providers = $compropagoCash->getProviders(
    $limit = 0,
    $currency = 'MXN'
);
```

### Crear una nueva orden de pago en efectivo
```php
<?php
$data = [
    "order_id" => "10002",
    "order_name" => "Test ComproPago CASH",
    "order_price" => 157.25,
    "image_url" => "http://dummyurl.com/prod10002.jpg",
    "customer_name" => "Nombre del Cliente",
    "customer_email" => "cliente@dominio.com",
    "customer_phone" => "55222999888",
    "currency" => 'MXN',
    "payment_type" => "OXXO"
];

/**
 * Creación de orden para cobro en efectivo por medio de ComproPago
 * 
 * @param array $data   Información de la orden
 * @return array        Estructura con información de la orden generada
 */
$order = $compropagoCash->createOrder($data);
```

### Verificar el estatus de la orden
```php
<?php

/**
 * Verificar la información de una orden en efectivo
 * 
 * @param string $orderId   ID de la orden generada por medio de efectivo
 * @return array            Estructura con información de la orden generada en efectivo
 */
$verified = $compropagoCash->verifyOrder($order['id']);
```
Enviar instrucciones por SMS
============================

Para poder enviar las instrucciones de pago mediante mensajes SMS, deberá crear
una instancia del objecto `SMS` y porsteriormente configurar sus llaves de acceso.
```php
<?php

# Importar objeto Sms
use CompropagoSdk\Resources\Sms;

/**
 * Configuración de las llaves de ComproPago
 * 
 * @param string $public   Llave pública correspondiente al modo de la tienda
 * @param string $private  Llave privada correspondiente al modo de la tienda
 */
$compropagoSms = (new Sms)->withKeys(
    'pk_test_xxxxxxxxxxxxxxxxxx',
    'sk_test_xxxxxxxxxxxxxxxxxx'
);

/**
 * Llamada al método del API para envío de las instrucciones por SMS
 * 
 * @param $phoneNumber  Número al cual se enviaran las instrucciones
 * @param $orderId      Id de la orden de compra de la cual se enviaran las instrucciones
 */
$smsInfo = $compropagoSms->sendToOrder(
    "55xxxxxxxx",
    "ch_xxxxx-xxxxx-xxxxx-xxxxx"
);
```

Webhooks
========

Los webhooks son de suma importancia para el procesamiento de las ordenes de ComproPago,
estos se encargaran de recibir las notificaciones del cambio en los estatus en las ordenes
de compra generadas; también deberán contener parte de la lógica de aprobación en su
tienda en linea. El proceso que siguen es el siguiente.

1. Cuando una orden cambia su estatus, nuestra plataforma le notificara a cada una de las rutas registradas.
2. Dicha notificacion cuenta con la información de la orden modificada en formato JSON.

Los webhooks registrados se pueden visualizar en el panel de ComproPago
- [Ir Webhooks en panel de ComproPago](https://panel.compropago.com/panel/webhooks_list)

Para poder acceder a las funciones del API que controlan los webhook,
deberá crear una instancia del objecto `Webhook`.
```php
<?php

# Importar objeto Webhook
use CompropagoSdk\Resources\Webhook;

/**
 * Configuración de las llaves de ComproPago
 * 
 * @param string $public   Llave pública correspondiente al modo de la tienda
 * @param string $private  Llave privada correspondiente al modo de la tienda
 */
$compropagoWebhook = (new Webhook)->withKeys(
    'pk_test_xxxxxxxxxxxxxxxxxx',
    'sk_test_xxxxxxxxxxxxxxxxxx'
);
```

Registrar un nuevo webhook
--------------------------
```php
<?php
/**
 * @param string $url   URL que será registrada como EndPoint del webhook
 * @return array        Estructura del Webhook
 */
$webhookInfo = $compropagoWebhook->create(
    "https://mitienda.com/webhook"
);
```

Listar webhooks registrados
---------------------------
```php
<?php

/**
 * @return array    Estructura del Webhook
 */
$listWebhooks = $compropagoWebhook->getAll();
```

Actualizar un webhook
---------------------
```php

/**
 * @param string $webhookId     ID de un webhook previamente registrado
 * @param string $url           URL nueva que será registrada como EndPoint del webhook
 * @return array                Estructura del Webhook
 */
<?php
$webhookInfo = $obj->update(
    $webhookInfo['id'],
    "https://mitienda.com/new_webhook"
);
```

Eliminar un webhook
-------------------
```php
<?php

/**
 * @param string $webhookId     ID de un webhook previamente registrado
 * @return array                Estructura del Webhook
 */
$webhookInfo = $compropagoWebhook->delete($webhookInfo['id']);
```
