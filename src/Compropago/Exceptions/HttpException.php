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
 * Exception implementation of Compropago API
 * @since 1.1.1
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */

namespace Compropago\Sdk\Exceptions;


/**
 * @var    finalMsg 	string
 * @method setFinalMsg 	void
 */
class HttpException extends BaseException
{
    /**
     * Mensaje final de la excepción
     * @var string
     */
    private $finalMsg;

    /**
     * Constructor para Excepciones de errores Http
     * @param int          	  $code    Numero de error Http
     * @param string          $message Mensaje de la excepcion
     * @param \Exception|null $previus Excepcion anterior
     */
    public function __construct($code, $message = null, \Exception $previus = null)
    {
        $this->setFinalMsg($code, $message);

        parent::__construct($this->finalMsg, $code, $previus);
    }

    /**
     * Generacion del mensaje final de error
     * @param int    $code    Numero de error Http
     * @param string $message Mensaje de la excepcion
     */
    private function setFinalMsg($code, $message)
    {
        if(!empty($message)){
            $this->finalMsg = "CODE ".$code.": ".$message;
        }else{
            $this->finalMsg = "CODE ".$code.": Unspected Http Error Request.";
        }
    }
}