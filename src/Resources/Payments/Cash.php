<?php

namespace CompropagoSdk\Resources\Payments;

use CompropagoSdk\Helpers\ValidationHelper;
use Requests;

class Cash
{
    use ValidationHelper;

    /**
     * Basic auth credentials
     *
     * @var array
     */
    private $auth;

    /**
     * API url for cash resource
     */
    const API_URL = 'https://api.compropago.com/v1';

    /**
     * Cash Constructor
     */
    public function __construct()
    {
        $this->auth = ['auth' => null];
    }

    /**
     * Basic auth information for cash resource
     *
     * @param string $user     Private key of ComproPago panel
     * @param string $password Public key of ComproPago panel
     *
     * @return Cash Self instace
     */
    public function withAuth($user, $password)
    {
        $this->auth['auth'] = [$user, $password];
        return $this;
    }

    /**
     * Return a list of the default Cash Providers of ComproPago
     *
     * @return array
     */
    public function listDefaultProviders()
    {
        $endpoint = self::API_URL . '/providers/true';

        $res = Requests::get($endpoint);

        $this->validateResponse($res);

        return json_decode($res->body, true);
    }
}
