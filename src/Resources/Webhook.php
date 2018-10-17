<?php

namespace CompropagoSdk\Resources;

use CompropagoSdk\Resources\AbstractResource;
use Requests;

class Webhook extends AbstractResource
{
    /**
     * Webhook Construct
     */
    public function __construct()
    {
        parent::__construct();
        $this->apiUrl = 'https://api.compropago.com/v1';
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getAll()
    {
        $endpoint = "{$this->apiUrl}/webhooks/stores";

        $res = Requests::get(
            $endpoint,
            array(),
            $this->options
        );
        $this->validateResponse($res);

        return json_decode($res->body, true);
    }

    public function create($url)
    {
        $enpoint = "{$this->apiUrl}/webhooks/stores";
    }

    public function update($webhookId, $url)
    {
        $enpoint = "{$this->apiUrl}/webhooks/stores/{$webhookId}";
    }

    public function delete($webhookId)
    {
        $enpoint = "{$this->apiUrl}/webhooks/stores/{$webhookId}";
    }
}
