<?php

namespace Handler\Account;

use Core\Application\Services\AdminService;
use Exception;
use Handler\BaseHandler;
use Handler\User\UserHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class AccountHandler extends BaseHandler
{
    protected static AccountHandler $instance;
    protected AdminService $service;
    private function __construct(AdminService $service)
    {
        $this->service = $service;
    }

    public static function getInstance(AdminService $adminService): AccountHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $adminService
            );
        }
        return self::$instance;
    }

    public function put($params = null): void
    {
        try {
            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
                $firstName = $params['first_name'];
                $lastName = $params['last_name'];
                $newPassword = $params['password'];

                $user = $this->service->getUserById($userId);
                if ($user !== null) {
                    $user->setFirstName($firstName);
                    $user->setLastName($lastName);
                    if (isset($newPassword)){
                        $user->setPasswordHash($newPassword);
                    }

                    $result =$this->service->updateUser($user);
                    if ($result) {
                        $_SESSION['first_name'] = $firstName;
                        if ($lastName === null){
                            $_SESSION['last_name'] = '';
                        } else {
                            $_SESSION['last_name'] = $lastName;
                        }
                        $_SESSION['is_subscribed'] = $user->getIsSubscribed();
                        $response = new Response(true, HttpStatusCode::OK, "User update success", $user->toArray());
                    } else {
                        $response = new Response(false, HttpStatusCode::NO_CONTENT, "User update failed", null);
                    }
                } else {
                    $response = new Response(false, HttpStatusCode::NOT_FOUND, "User not found", null);
                }
            } else {
                $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Invalid user data", null);
            }
            $response->encode_to_JSON();
            return;
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "User update failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
            return;
        }
    }
}