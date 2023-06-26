<?php

namespace Rozeo\GpsLogger\Http\Request\Factory;

use Psr\Http\Message\ServerRequestFactoryInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rozeo\GpsLogger\Http\Request\MirrorRequest;

class MirrorRequestFactory implements ApplicationRequestFactoryInterface
{

    const REGEX = '/^\/mirror\/(\d+)$/';

    public function isMatch(ServerRequestInterface $request): bool
    {
        return preg_match(self::REGEX, parse_url($request->getUri(), PHP_URL_PATH));
    }

    public function create(ServerRequestInterface $request): MirrorRequest
    {
        preg_match(self::REGEX, parse_url($request->getUri(), PHP_URL_PATH), $match);

        return new MirrorRequest(
            (int) $match[1],
            $request->getQueryParams()['name'] ?? 'John',
        );
    }
}