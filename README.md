ComproPago, PHP API client (SDK)
==============================

## Ayuda y Soporte de ComproPago

- [Centro de ayuda y soporte](https://compropago.com/ayuda-y-soporte)
- [Solicitar Integración](https://compropago.com/integracion)
- [Guía para Empezar a usar ComproPago](https://compropago.com/ayuda-y-soporte/como-comenzar-a-usar-compropago)
- [Información de Contacto](https://compropago.com/contacto)

## Requerimientos

* [PHP >= 5.3](http://www.php.net/)
* [PHP JSON extension](http://php.net/manual/en/book.json.php)
* [PHP cURL extension](http://php.net/manual/en/book.curl.php)

## Instalación ComproPago SDK

### Instalación usando Composer

La manera recomenda de instalar la SDK de ComproPago es por medio de [Composer](http://getcomposer.org).
- [Como instalar Composer?](https://getcomposer.org/doc/00-intro.md)

Para instalar la última versión **Estable de la SDK**, ejecuta el comando de Composer:

```bash
composer require compropago/php-sdk
```

O agregando manualmente al archivo composer.json
```bash
"require": { 
		"compropago/php-sdk":"^1.0"
	}
```
```bash
composer install
```

Después de la instalación para poder hacer uso de la librería es **necesario incluir** el autoloader de Composer:

```php
require 'vendor/autoload.php';
```

Para actualizar el SDK de ComproPago a la última versión estable ejecutar:

 ```bash
composer update
 ```
### Instalación descargando archivo ZIP

Descargar y descomprimir el archivo de la versión a utilizar:
- Última-Estable [v.1.0.1](http://ec2-54-153-109-209.us-west-1.compute.amazonaws.com/compropago-php-sdk-1-0-1.zip)

Para poder hacer uso de la librería es **necesario incluir** el autoloader que se encuentra dentro de la carpeta **vendor** del archivo que descomprimió:
```php
require 'vendor/autoload.php';
```
###Instalación por GitHub

Puede descargar alguna de las versiones que hemos publicado en:
- [Consultar Versiones Publicadas en GitHub](https://github.com/compropago/compropago-php/releases)

O si o lo desea puede obtener el repositorio
 ```bash
 #Última Versión estable
git clone -b 1.0.1 https://github.com/compropago/compropago-php.git

 #repositorio en su estado actual (*puede no ser versón estable*)
git clone https://github.com/compropago/compropago-php.git
 ``` 

## Guía de Versiones

| Version | Status      | Packagist            | Namespace    | Repo                      | Docs                      | 
|---------|-------------|----------------------|--------------|---------------------------|---------------------------|
| 1.0.x   | Latest      | `compropago/php-sdk` | `Compropago` | [v1.0.x][compropago-repo] | [v1][compropago-1-docs]   | 

[compropago-repo]: https://github.com/compropago/compropago-php
[compropago-1-docs]: https://compropago.com/documentacion/api
