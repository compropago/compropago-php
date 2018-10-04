<?php

namespace CompropagoSdk\Resources\Payments;

use CompropagoSdk\Resources\AbstractResource;
use Requests;

class Cash extends AbstractResource
{
    /**
     * Cash Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiUrl = 'https://api.compropago.com/v1';
    }

    /**
     * Return a list of the default Cash Providers of ComproPago
     *
     * @return array
     */
    public function listDefaultProviders()
    {
        $endpoint = "{$this->apiUrl}/providers/true";

        $res = Requests::get($endpoint);
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }
}
