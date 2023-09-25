<?php

namespace Handlers;

abstract class BaseHandler
{
    protected static BaseHandler $instance;

    // Asumsinya adalah setiap handler hanya memakai satu service.
    protected $service;

    protected function __construct($service)
    {
        $this->service = $service;
    }

    public static function getInstance(): BaseHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(null);
        }
        return self::$instance;
    }

    protected function get($params)
    {
        // Need new exception here
    }

    protected function post($params)
    {
        // Need new exception here

    }

    protected function put($params)
    {
        // Need new exception here

    }

    protected function delete($params)
    {
        // Need new exception here
    }

}