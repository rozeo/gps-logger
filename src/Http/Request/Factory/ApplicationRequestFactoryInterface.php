<?php

namespace Rozeo\GpsLogger\Http\Request\Factory;

use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;

interface ApplicationRequestFactoryInterface {
    public function isMatch(ServerRequestInterface $request): bool;
}