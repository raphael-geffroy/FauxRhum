<?php
declare(strict_types=1);

namespace Framework\Services;

use ReflectionClass;
use ReflectionException;

final class Container
{
    private array $recipes = [];
    private array $services = [];

    public function set(string $class, callable $callable): self
    {
        $this->recipes[$class]= $callable;
        return $this;
    }

    /**
     * @throws ReflectionException
     */
    public function get(string $class): mixed
    {
        if(isset($this->services[$class])){
            return $this->services[$class];
        }
        if(isset($this->recipes[$class])){
            $service = $this->recipes[$class]($this);
            $this->services[$class] = $service;
            return $service;
        }
        $reflection = new ReflectionClass($class);
        $args = [];
        $constructor = $reflection->getConstructor();
        if(!$constructor){
            return $reflection->newInstance();
        }
        foreach ($reflection->getConstructor()->getParameters() as $param){
            $args[] = $this->get($param->getType()->getName());
        }
        return $reflection->newInstanceArgs($args);
    }
}