<?php

namespace Rozeo\GpsLogger\Kernel;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private array $instances = [];

    public function set(string $instanceName, $instance): self
    {
        $this->instances[$instanceName] = $instance;
        return $this;
    }

    /**
     * @throws \ReflectionException
     */
    public function get(string $id)
    {
        return $this->instances[$id] = $this->has($id)
            ? $this->resolveInstance($this->instances[$id])
            : $this->resolveInstance($id);
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->instances);
    }

    /**
     * @throws \ReflectionException
     */
    private function resolveInstance($target)
    {
        if (is_object($target)) {
            return $target;
        }

        $classRef = new \ReflectionClass($target);
        $constructParameters = [];

        foreach ($classRef->getConstructor()?->getParameters() ?? [] as $parameter) {
            $constructParameters[] = $this->get($parameter->getType()->getName());
        }

        return new $target(...$constructParameters);
    }
}