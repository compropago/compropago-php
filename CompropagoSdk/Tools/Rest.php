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


/**
 * Class Rest Proporciona los metodos de conexion
 * @package CompropagoSdk\Tools
 */
class Rest
{
    /**
     * Ejecuta peticiones Get al API
     *
     * @param $url              string      Url a la cual se generara la peticion
     * @param string $auth                  Cadena de autentificacion
     * @return mixed
     * @throws \Exception
     */
    public static function get($url, $auth="")
    {
        try{
            $ch = Http::initHttp($url);
            Http::setMethod($ch,'GET');
            Http::setAuth($ch,$auth);

            $response = Http::execHttp($ch);

            if(empty($response)){
                throw new \Exception("Respuesta vacia");
            }else{
                return $response;
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(),$e->getCode(),$e);
        }
    }

    /**
     * @param $url              string      Url a la cual se generara la peticion
     * @param $auth             string      Cadena de autentificacion
     * @param $data             string      Parametros a enviar
     * @return mixed
     * @throws \Exception
     */
    public static function post($url, $auth, $data)
    {
        try{
            $ch = Http::initHttp($url);
            Http::setMethod($ch, 'POST');
            Http::setAuth($ch, $auth);
            Http::setPostFields($ch, $data);

            $response = Http::execHttp($ch);

            if(empty($response)){
                throw new \Exception("Respuesta vacia");
            }else{
                return $response;
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(),$e->getCode(),$e);
        }
    }

    /**
     * @param $url              string      Url a la cual se generara la peticion
     * @param $auth             string      Cadena de autentificacion
     * @param $data             string      Parametros a enviar
     * @return mixed
     * @throws \Exception
     */
    public static function put($url, $auth, $data)
    {
        try{
            $ch = Http::initHttp($url);
            Http::setMethod($ch, 'PUT');
            Http::setAuth($ch, $auth);
            Http::setPostFields($ch, $data);

            $response = Http::execHttp($ch);

            if(empty($response)){
                throw new \Exception("Respuesta vacia");
            }else{
                return $response;
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(),$e->getCode(),$e);
        }
    }

    public static function delete($url, $auth, $data = null)
    {
        $ch = Http::initHttp($url);
        Http::setMethod($ch, 'DELETE');
        Http::setAuth($ch, $auth);

        if(!empty($data))
            Http::setPostFields($ch, $data);

        $response = Http::execHttp($ch);

        if(empty($response)){
            throw new \Exception("Respuesta vacia");
        }else{
            return $response;
        }
    }
}