<?php
namespace Handler\Auth;

use Exception;
use Handler\BaseHandler;

class RegisterHandler extends BaseHandler
{
    protected static RegisterHandler $instance;
    protected $service;
    private function __construct($service)
    {
        $this->service = $service;
    }

    public static function getInstance($container): RegisterHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('userService')
            );
        }
        return self::$instance;
    }
    public function get($params = null) {
        redirect('register');
    }

    public function post($params = null) {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->service->register($username, $password)) {
                redirect('login');
            } else {
                redirect('register');
            }
            exit();
        } catch (Exception $e) {
            redirect('register');
            exit();
        }
    }

}