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
 * Compropago php-sdk
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */


namespace CompropagoSdk\Factory;

use CompropagoSdk\Exceptions\FactoryExceptions;
use CompropagoSdk\Factory\Abs\CpOrderInfo;
use CompropagoSdk\Factory\Abs\EvalAuthInfo;
use CompropagoSdk\Factory\Abs\NewOrderInfo;
use CompropagoSdk\Factory\Json\Serialize;
use CompropagoSdk\Models\Provider;

/**
 * Class Factory
 * @package CompropagoSdk\Factory
 */
class Factory
{
    /**
     * Verifica la version de la respuesta de una peticion
     *
     * @param $source       string Cadena Json con el contenido de la respuesta
     * @return string
     */
    private static function verifyVersion($source)
    {
        $obj = json_decode($source);
        return isset($obj->api_version) ? $obj->api_version : "1.1";
    }


    /**
     * Constructor de objetos EvalOutInfo
     *
     * @param $source               string Cadena Json con el contenido a construir como objeto
     * @return EvalAuthInfo
     * @throws FactoryExceptions
     */
    public static function evalAuthInfo($source)
    {
        switch(self::verifyVersion($source)){
            case '1.1':
                return Serialize::evalAuthInfo11($source);
                break;
            case '1.0':
                return Serialize::evalAuthInfo10($source);
                break;
            default:
                throw new FactoryExceptions("Version no soportada");
                break;
        }
    }

    /**
     * Construye un arreglo de Objetos tipo \CompropagoSdk\Models\Provider
     *
     * @param $source   string Cadena Json con el contenido a construir
     * @return array
     */
    public static function arrayProviders($source)
    {
        $jsonObj= json_decode($source);
        usort($jsonObj, function($a, $b) {
            return $a->rank > $b->rank ? 1 : -1;
        });

        $res = array();

        foreach($jsonObj as $val){
            $provider = new Provider();

            $provider->name = $val->name;
            $provider->store_image = $val->store_image;
            $provider->is_active = $val->is_active;
            $provider->image_small = $val->image_small;
            $provider->image_medium = $val->image_medium;
            $provider->image_large = $val->image_large;
            $provider->internal_name = $val->internal_name;
            $provider->rank = $val->rank;

            $res[] = $provider;
        }

        return $res;
    }

    /**
     * @param $source
     * @return CpOrderInfo
     * @throws FactoryExceptions
     */
    public static function cpOrderInfo($source)
    {
        switch(self::verifyVersion($source)){
            case '1.1':
                return Serialize::cpOrderInfo11($source);
                break;
            case '1.0':
                return Serialize::cpOrderInfo10($source);
                break;
            default:
                throw new FactoryExceptions("Version no soportada");
                break;
        }
    }

    /**
     * @param $source
     * @return NewOrderInfo
     * @throws FactoryExceptions
     */
    public static function newOrderInfo($source)
    {
        switch(self::verifyVersion($source)){
            case '1.1':
                return Serialize::newOrderInfo11($source);
                break;
            case '1.0':
                return Serialize::newOrderInfo10($source);
                break;
            default:
                throw new FactoryExceptions("Version no soportada");
                break;
        }
    }
}