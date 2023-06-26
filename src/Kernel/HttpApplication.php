<?php

namespace Rozeo\GpsLogger\Kernel;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ServerRequestFactoryInterface;
use Rozeo\GpsLogger\Http\Controllers\ControllerInterface;

class HttpApplication
{
    /**
     * @var ControllerInterface[]
     */
    private array $controllers = [];

    private ResponseWriter $responseWriter;

    public function __construct(
        private readonly ContainerInterface $container,
        private readonly ServerRequestFactoryInterface $serverRequestFactory,
    )
    {
        $this->responseWriter = new ResponseWriter();
    }

    public function bindController(string $controllerName): self
    {
        $this->controllers[] = $this->container->get($controllerName);
        return $this;
    }

    public function handle()
    {
        $serverRequest = $this->serverRequestFactory->createServerRequest(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $_REQUEST
        );

        foreach ($this->controllers as $controller) {
            if ($controller->isTarget($serverRequest)) {
                $this->responseWriter->write($controller->handle($serverRequest));
                return;
            }
        }
    }
}