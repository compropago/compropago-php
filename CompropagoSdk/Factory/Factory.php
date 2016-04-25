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
use CompropagoSdk\Factory\Abs\EvalAuthInfo;
use CompropagoSdk\Factory\Json\Serialize;

class Factory
{
    private static function verifyVersion($source)
    {
        $obj = json_decode($source);
        return isset($obj->api_version) ? $obj->api_version : "1.1";
    }

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
}