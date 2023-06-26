<?php

namespace Rozeo\GpsLogger\Http\Request;

use Psr\Http\Message\ServerRequestInterface;

readonly class MirrorRequest
{

    public function __construct(public int $id, public string $name)
    {

    }
}