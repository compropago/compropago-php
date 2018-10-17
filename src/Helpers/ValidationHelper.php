<?php

namespace CompropagoSdk\Helpers;

use Requests_Response;

trait ValidationHelper
{
    public function validateResponse(Requests_Response $res)
    {
        $body = json_decode($res->body, true);

        if ($res->status_code != 200 || (isset($body['code']) && $body['code'] != 200)) {
            $message = sprintf('Request Error [%d]: %s', $res->status_code, $res->body);
            throw new \Exception($message, $res->status_code);
        }
    }
}
