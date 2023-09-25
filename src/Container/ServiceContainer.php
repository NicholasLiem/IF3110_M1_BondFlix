<?php

namespace Container;
use Exception;
class ServiceContainer implements IContainer
{
    private array $services = [];

    public function register($name, $factory)
    {
        $this->services[$name] = $factory;
    }


    /**
     * @throws Exception
     */
    public function resolve($name)
    {
        if (isset($this->services[$name])) {
            $factory = $this->services[$name];
            return $factory($this);
        } else {
            throw new Exception("Service '$name' not found in the container.");
        }
    }
}