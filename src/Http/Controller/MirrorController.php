<?php

namespace Rozeo\GpsLogger\Http\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Rozeo\GpsLogger\Http\Request\Factory\MirrorRequestFactory;
use Rozeo\GpsLogger\Http\Request\MirrorRequest;

class MirrorController implements ControllerInterface
{
    public function __construct(
        private readonly MirrorRequestFactory $requestFactory,
        private readonly ResponseFactoryInterface $responseFactory,
        private readonly StreamFactoryInterface $streamFactory,
    )
    {

    }

    public function isTarget(ServerRequestInterface $serverRequest): bool
    {
        return $serverRequest->getMethod() === 'GET' &&
            $this->requestFactory->isMatch($serverRequest);
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $request = $this->requestFactory->create($request);

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