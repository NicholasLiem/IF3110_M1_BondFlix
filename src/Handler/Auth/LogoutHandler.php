<?php

namespace Handler\Auth;

use Handler\BaseHandler;

class LogoutHandler extends BaseHandler
{

    protected static LogoutHandler $instance;
    protected $service;

    private function __construct($service)
    {
        $this->service=$service;
    }

    public static function getInstance($container): LogoutHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('userService')
            );
        }
        return self::$instance;
    }
    public function get($params = null) {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $_SESSION = array();

            session_destroy();
        }

        redirect('logout');
    }
}