<?php
namespace Handlers;

use Core\Application\Services\UserService;
use Exception;
class RegisterHandler
{
    protected static RegisterHandler $instance;
    protected UserService $userService;
    private function __construct($service)
    {
        $this->userService = $service;
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
    public function showPage(): void {
        require_once BASE_PATH . '/public/view/register.php';
    }

    public function register() {
        try {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($this->userService->register($username, $password)) {
                header("Location: /dashboard");
            } else {
                header("Location: /register");
            }
            exit();
        } catch (Exception $e) {
            header("Location: /register");
            exit();
        }
    }

}