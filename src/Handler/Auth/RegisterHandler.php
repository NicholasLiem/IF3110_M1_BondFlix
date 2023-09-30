<?php
namespace Handler\Auth;

use Exception;
use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class RegisterHandler extends BaseHandler
{
    protected static $instance;
    protected $service;

    private function __construct($service)
    {
        parent::__construct($service);
    }

    public static function getInstance($container): RegisterHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('authService')
            );
        }
        return self::$instance;
    }

    public function post($params = null)
    {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];

            $user = $this->service->register($username, $password, $first_name, $last_name);
            $response = new Response(true, HttpStatusCode::OK, "User registered successfully", $user->toArray());
            $response->encode_to_JSON();

        } catch (Exception $e) {

            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Registration failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }
}
