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
     * AbstractResource Construct
     */
    public function __construct()
    {
        $this->auth = ['auth' => null];
    }

    /**
     * Set keys for the ComproPago API
     *
     * @param string $public  Public key of ComproPago panel
     * @param string $private Private key of ComproPago panel
     *
     * @return AbstractResorce Self resource instance
     */
    public function withKeys($public, $private)
    {
        $this->auth['auth'] = [$pruvate, $public];
        return $this;
    }

    /**
     * Return an array with the auth information of the request
     *
     * @return array Auth array data
     */
    public function getAuth()
    {
        return $this->auth['auth'];
    }
}
