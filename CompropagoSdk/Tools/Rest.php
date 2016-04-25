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


use CompropagoSdk\Exceptions\RestExceptions;

class Rest
{

    public static function get($url, $auth="")
    {
        try{
            $ch = Http::initHttp($url);
            Http::setMethod($ch,'GET');
            Http::setAuth($ch,$auth);

            $response = Http::execHttp($ch);

            if(empty($response)){
                throw new RestExceptions("Respuesta vacia");
            }else{
                return $response;
            }
        }catch(\Exception $e){
            throw new RestExceptions($e->getMessage(),$e->getCode(),$e);
        }
    }

    public static function post($url, $auth, $data=array())
    {

    }

    private static function prepareFields($fields)
    {
        $res = null;
        foreach($fields as $key => $value){
            $res = empty($res) ? $key."=".$value : "&".$key."=".$value;
        }
        return $res;
    }
}