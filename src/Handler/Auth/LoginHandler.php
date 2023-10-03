<?php
namespace Handler\Auth;

use Exception;
use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class LoginHandler extends BaseHandler
{
    protected static $instance;
    protected $service;
    private function __construct($service)
    {
        parent::__construct($service);
    }

    public static function getInstance($container): LoginHandler
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
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {

            $user = $this->service->login($username, $password);
            $response = new Response(true, HttpStatusCode::OK ,"User successfully logged in", $user->toArray());
            $response->encode_to_JSON();

        } catch (Exception $e) {

            $response = new Response(false, HttpStatusCode::FORBIDDEN, "Invalid credentials", null);
            $response->encode_to_JSON();

        }

    }
}