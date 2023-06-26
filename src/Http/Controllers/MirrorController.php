<?php

namespace Rozeo\GpsLogger\Http\Controllers;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Rozeo\GpsLogger\Http\Requests\MirrorRequest;

class MirrorController implements ControllerInterface
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
            MirrorRequest::matchRegex($serverRequest);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $request = MirrorRequest::create($request);

        $obj = [
            'id' => $request->id,
            'name' => $request->name,
        ];

        return $this->responseFactory
            ->createResponse(200)
            ->withBody($this->streamFactory->createStream(json_encode($obj)))
            ->withHeader('Content-Type', 'application/json');
    }
}