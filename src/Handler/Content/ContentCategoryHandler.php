<?php
namespace Handler\Content;

use Exception;
use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class ContentCategoryHandler extends BaseHandler {
    
    protected static $instance;
    protected $service;

    private function __construct($service)
    {
        parent::__construct($service);
    }

    public static function getInstance($container): ContentHandler {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('contentService')
            );
        }
        return self::$instance;
    }

    protected function get($params = null)
    {
        //TODO: implement
    }

    protected function post($params = null)
    {
        //TODO: implement

    }

    protected function put($params = null)
    {
        //TODO: implement

    }

    protected function delete($params = null)
    {
        //TODO: implement
    }
}