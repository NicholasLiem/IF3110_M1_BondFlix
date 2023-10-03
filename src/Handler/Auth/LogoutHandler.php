<?php

namespace Handler\Auth;

use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class LogoutHandler extends BaseHandler
{

    protected static $instance;
    protected $service;

    private function __construct($service)
    {
        parent::__construct($service);
    }

    public static function getInstance($container): LogoutHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('authService')
            );
        }
        return self::$instance;
    }
    public function post($params = null): void
    {

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user_id'])) {
            $_SESSION = array();
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }
            session_destroy();
        }

        $response = new Response(true, HttpStatusCode::OK ,"User successfully logged out", null);
        $response->encode_to_JSON();
    }
}