<?php

namespace Containers;
use Exception;
class ServiceContainer
{
    private $services = [];

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