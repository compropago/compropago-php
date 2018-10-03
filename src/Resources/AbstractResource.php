<?php

namespace CompropagoSdk\Resources;

use CompropagoSdk\Helpers\ValidationHelper;

abstract class AbstractResource
{
    use ValidationHelper;

    /**
     * Authorization for the API requests
     *
     * @var array
     */
    protected $auth = [];

    /**
     * Base API url for the endpoints
     *
     * @var string
     */
    protected $apiUrl = '';

    /**
     * Set keys for the ComproPago API
     *
     * @param string $public  Public key of ComproPago panel
     * @param string $private Private key of ComproPago panel
     *
     * @return AbstractResorce
     */
    public function withKeys($public, $private)
    {
        $this->auth['auth'] = [$pruvate, $public];
        return $this;
    }
}
