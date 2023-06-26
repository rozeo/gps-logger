<?php

namespace Rozeo\GpsLogger\Http\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class IndexController implements ControllerInterface
{
    public function __construct(
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly StreamFactoryInterface $streamFactory,
    )
    {

    }

    public function isTarget(ServerRequestInterface $serverRequest): bool
    {
        return $serverRequest->getMethod() === 'GET' &&
            preg_match('/^\/?$/', $serverRequest->getUri());
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $obj = [
            'id' => 123,
            'name' => 'John',
        ];

        return $this->responseFactory
            ->createResponse(200)
            ->withBody($this->streamFactory->createStream(json_encode($obj)))
            ->withHeader('Content-Type', 'application/json');
    }
}