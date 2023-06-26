<?php

namespace Rozeo\GpsLogger\Http\Request;

use Psr\Http\Message\ServerRequestInterface;

readonly class MirrorRequest
{
    const REGEX = '/^\/mirror\/(\d+)$/';

    public function __construct(public int $id, public string $name)
    {

    }

    public static function create(ServerRequestInterface $request): MirrorRequest
    {
        preg_match(self::REGEX, parse_url($request->getUri(), PHP_URL_PATH), $match);

        return new self(
            (int) $match[1],
            $request->getQueryParams()['name'] ?? 'John',
        );
    }

    public static function matchRegex(ServerRequestInterface $request): bool
    {
        return preg_match(self::REGEX, parse_url($request->getUri(), PHP_URL_PATH));
    }
}