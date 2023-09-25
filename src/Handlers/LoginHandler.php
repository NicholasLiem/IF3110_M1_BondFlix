<?php
namespace Handlers;

use Core\Application\Services\UserService;
use Exception;
class LoginHandler
{
    protected static LoginHandler $instance;
    protected UserService $userService;
    private function __construct($service)
    {
        $this->userService = $service;
    }

    public static function getInstance($container): LoginHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('userService')
            );
        }
        return self::$instance;
    }
    public function get(): void {
        require_once BASE_PATH . '/public/view/login.php';
    }

    public function post(): void {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userService->login($username, $password)) {
                header("Location: /dashboard");
            } else {
                header("Location: /login");
            }
            exit();
        } catch (Exception $e) {
            header("Location: /login");
            exit();
        }
    }

}