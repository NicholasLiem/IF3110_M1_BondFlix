<?php
namespace Handler\User;

use Core\Application\Services\AdminService;
use Exception;
use Handler\BaseHandler;
use Utils\Http\HttpStatusCode;
use Utils\Response\Response;

class UserHandler extends BaseHandler
{
    protected static $instance;
    protected $service;

    private function __construct($service)
    {
        parent::__construct($service);
    }

    public static function getInstance($container): UserHandler
    {
        if (!isset(self::$instance)) {
            self::$instance = new static(
                $container->resolve('adminService')
            );
        }
        return self::$instance;
    }

    public function get($params = null): void
    {
        try {
            if (isset($params['username'])) {
                $user = $this->service->getUserByUsername($params['username']);
                $response = new Response(true, HttpStatusCode::OK, "User(s) retrieved successfully", $user->toArray());
            } else {
                $users = $this->service->getAllUsers();

                $userArrays = array_map(function ($user) {
                    return $user->toArray();
                }, $users);

                $response = new Response(true, HttpStatusCode::OK, "User(s) retrieved successfully", $userArrays);
            }

            $response->encode_to_JSON();
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "User(s) retrieval failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }

    public function delete($params = null): void
    {
        try {

            if (isset($params['userId'])) {
                $user_id = $params['userId'];
                $user = $this->service->getUserById($user_id);
                if ($user){
                    /**
                     * Problem on deleting someone's session
                     * https://w3schools.invisionzone.com/topic/51237-destroy-session-of-other-user/
                     * Sol: https://w3schools.invisionzone.com/topic/9731-custom-session-save-handlers/
                     * Desc: Not gonna implement this yet.
                     */
                    $status = $this->service->deleteUserById($user_id);
                    if ($status) {
                        $response = new Response(true, HttpStatusCode::OK, "User(s) deletion success", $user->toArray());
                    } else {
                        $response = new Response(false, HttpStatusCode::NO_CONTENT, "User(s) deletion failed", null);
                    }
                } else {
                    $response = new Response(false, HttpStatusCode::NO_CONTENT, "User(s) deletion failed, user not found", null);
                }
            } else {
                $response = new Response(false, HttpStatusCode::NO_CONTENT, "User(s) deletion failed, user parameter id not found", null);
            }
            $response->encode_to_JSON();
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "User(s) deletion failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }
}
