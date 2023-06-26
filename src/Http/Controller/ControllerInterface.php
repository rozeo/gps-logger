<?php

namespace Rozeo\GpsLogger\Http\Controller;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

interface ControllerInterface extends RequestHandlerInterface
{
    public function isTarget(ServerRequestInterface $serverRequest): bool;
}