<?php
namespace Handler\Auth;

use Core\Application\Services\AuthService;
use Exception;
use Handler\BaseHandler;

class LoginHandler extends BaseHandler
{
    protected static LoginHandler $instance;
    protected $service;
    private function __construct($service)
    {
        $this->service = $service;
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
    public function get($params = null)
    {
        redirect('login');
    }

    public function post($params = null)
    {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->service->login($username, $password)) {
                redirect('dashboard');
            } else {
                redirect('login');
            }
            exit();
        } catch (Exception $e) {
            redirect('login');
            exit();
        }
    }
}