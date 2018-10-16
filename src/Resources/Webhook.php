<?php

namespace CompropagoSdk\Resources;

use CompropagoSdk\Resources\AbstractResource;
use Requests;

class Webhook extends AbstractResource
{
    public function __construct()
    {
        parent::__construct();
        $this->apiUrl = 'https://api.compropago.com/v1';
    }
}
