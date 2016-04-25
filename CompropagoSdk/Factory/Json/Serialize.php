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


namespace CompropagoSdk\Factory\Json;


use CompropagoSdk\Factory\V10\EvalAuthInfo10;
use CompropagoSdk\Factory\V11\EvalAuthInfo11;


/**
 * Class Serialize Clase que convierte estandariza las diferentes respuestas en objetos similares
 * @package CompropagoSdk\Factory\Json
 */
class Serialize
{
    /**
     * @param $source           string Contenido Json
     * @return EvalAuthInfo10
     */
    public static function evalAuthInfo10($source)
    {
        $res = new EvalAuthInfo10();
        $obj = json_decode($source);

        $res->type = $obj->type;
        $res->livemode = $obj->livemode;
        $res->mode_key = $obj->mode_key;
        $res->message = $obj->message;
        $res->code = $obj->code;

        return $res;
    }

    /**
     * @param $source           string Contenido Json
     * @return EvalAuthInfo11
     */
    public static function evalAuthInfo11($source)
    {
        $res = new EvalAuthInfo11();
        $obj = json_decode($source);

        $res->type = $obj->type;
        $res->livemode = $obj->livemode;
        $res->mode_key = $obj->mode_key;
        $res->message = $obj->message;
        $res->code = $obj->code;

        return $res;
    }
}