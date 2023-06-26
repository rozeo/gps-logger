<?php

return [
    \Psr\Http\Message\RequestFactoryInterface::class => \Nyholm\Psr7\Factory\Psr17Factory::class,
    \Psr\Http\Message\ResponseFactoryInterface::class => \Nyholm\Psr7\Factory\Psr17Factory::class,
    \Psr\Http\Message\StreamFactoryInterface::class => \Nyholm\Psr7\Factory\Psr17Factory::class,
    \Psr\Http\Message\ServerRequestFactoryInterface::class => \Nyholm\Psr7\Factory\Psr17Factory::class,
];