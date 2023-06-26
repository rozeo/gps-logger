<?php

require_once __DIR__ . '/../vendor/autoload.php';

$container = new \Rozeo\GpsLogger\Kernel\Container();
foreach (require __DIR__ . '/../config/container.php' as $key => $instance) {
    $container->set($key, $instance);
}

$application = new \Rozeo\GpsLogger\Kernel\HttpApplication(
    $container,
    new \Nyholm\Psr7\Factory\Psr17Factory(),
);

$application
    ->bindController(\Rozeo\GpsLogger\Http\Controller\IndexController::class)
    ->bindController(\Rozeo\GpsLogger\Http\Controller\MirrorController::class)
    ->handle();