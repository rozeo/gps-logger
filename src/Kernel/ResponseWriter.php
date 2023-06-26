<?php

namespace Rozeo\GpsLogger\Kernel;

use Psr\Http\Message\ResponseInterface;

class ResponseWriter
{
    public function write(ResponseInterface $response)
    {
        header("HTTP/{$response->getProtocolVersion()} {$response->getStatusCode()}");
        foreach ($response->getHeaders() as $name => $values) {
            header($name . ': ' . implode('; ', $values));
        }

        $stream = $response->getBody();
        echo $stream->getContents();
    }
}