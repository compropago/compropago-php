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


namespace CompropagoSdk\Tools;


use CompropagoSdk\Exceptions\HttpException;

class Http
{
    public static function initHttp($url = null)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        return $ch;
    }

    public static function setMethod(&$ch,$method)
    {
        switch($method){
            case 'GET':
            case 'POST':
                curl_setopt($ch,CURLOPT_CUSTOMREQUEST, $method);
                break;
            default:
                throw new HttpException("Metodo no soportado");
                break;
        }
    }

    public static function setAuth(&$ch, $auth)
    {
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
    }

    public static function setPostFields(&$ch, $fields)
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
    }

    public static function execHttp(&$ch)
    {
        return curl_exec($ch);
    }
}