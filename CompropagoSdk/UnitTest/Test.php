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

namespace CompropagoSdk\UnitTest;

require_once __DIR__."/autoload.php";

use CompropagoSdk\Client;
use CompropagoSdk\Tools\Rest;
use CompropagoSdk\Tools\Validations;

class Test
{
    public function __construct()
    {
        $client = new Client(
            "pk_test_8781245a88240f9cf",
            "sk_test_56e31883637446b1b",
            false
        );


    }
}

new Test();