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
 * Compropago ${LIBRARI}
 * @author Eduardo Aguilar <eduardo.aguilar@compropago.com>
 */


namespace CompropagoSdk\Factory\V10;


use CompropagoSdk\Factory\Abs\EvalAuthInfo;


/**
 * Class EvalAuthInfo10
 * @package CompropagoSdk\Factory\V10
 */
class EvalAuthInfo10 extends EvalAuthInfo
{
    /**
     * @var string
     */
    public $type;
    /**
     * @var bool
     */
    public $livemode;
    /**
     * @var bool
     */
    public $mode_key;
    /**
     * @var string
     */
    public $message;

    /**
     * @var int
     */
    public $code;

    /**
     * EvalAuthInfo10 constructor.
     */
    public function __construct()
    {
    }

    /**
     * @override
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @override
     * @return bool
     */
    public function getLiveMode()
    {
        return $this->livemode;
    }

    /**
     * @override
     * @return bool
     */
    public function getModeKey()
    {
        return $this->mode_key;
    }

    /**
     * @override
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @override
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }
}