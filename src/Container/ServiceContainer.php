<?php

namespace Container;
use Exception;
use Utils\Logger\Logger;

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
            Logger::getInstance()->logMessage("Fail to load $name service");
            throw new Exception("Service '$name' not found in the container.");
        }
    }
}