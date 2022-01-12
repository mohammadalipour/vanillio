<?php

namespace App\Config;

use App\Exception\NotFoundException;
use MongoDB\Driver\Exception\ConnectionException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

class Container implements ContainerInterface
{
    private array $entries = [];

    /**
     * @throws ReflectionException
     * @throws NotFoundException
     */
    public function get(string $id)
    {
        if ($this->has($id)) {
            $entry = $this->entries[$id];

            if (is_callable($entry)) {
                return $entry($this);
            }

            $id = $entry;
        }

        return $this->resolve($id);
    }

    public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    /**
     * @throws ReflectionException
     * @throws NotFoundException
     */
    public function resolve(string $id)
    {
        try {
            $reflection = new ReflectionClass($id);
        } catch (ReflectionException $exception) {
            throw new NotFoundException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (!$reflection->isInstantiable()) {
            throw new ConnectionException("Class $id dose not instantiable");
        }

        if (!$constructor = $reflection->getConstructor()) {
            return new $id();
        }

        if (!$parameters = $constructor->getParameters()) {
            return new $id();
        }

        $dependencies = $this->makeDependencies($parameters, $id);

        return $reflection->newInstanceArgs($dependencies);
    }

    /**
     * @param array $parameters
     * @param string $id
     * @return array
     */
    private function makeDependencies(array $parameters, string $id): array
    {
        return array_map(function (ReflectionParameter $parameter) use ($id) {
            if (!$type = $parameter->getType()) {
                throw new ConnectionException("Failed to resolve class $id");
            } elseif ($type instanceof ReflectionUnionType) {
                throw new ConnectionException("Failed to resolve class $id because of union type");
            } elseif ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                return $this->get($type->getName());
            } else {
                throw new ConnectionException("Failed to resolve class $id, because param dose not valid");
            }
        }, $parameters);
    }
}