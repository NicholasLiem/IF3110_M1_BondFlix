<?php
namespace Handler\User;

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
                $username = $params['username'];
                $user = $this->service->getUserByUsername($username);
                if ($user) {
                    $response = new Response(true, HttpStatusCode::OK, "User retrieved successfully", $user->toArray());
                } else {
                    $response = new Response(false, HttpStatusCode::NOT_FOUND, "User not found", null);
                }
            } else {
                if (isset($params['query'])) {
                    $query = $params['query'];
                    $result = $this->service->processUserQuery($query);
                    if (empty($result)) {
                        $response = new Response(false, HttpStatusCode::OK, "No matching users found", null);
                    } else {
                        $userArrays = array_map(function ($user) {
                            return $user->toArray();
                        }, $result);
                        $response = new Response(true, HttpStatusCode::OK, "Query processed successfully", $userArrays);
                    }
                } else {
                    $users = $this->service->getAllUsers();
                    $userArrays = array_map(function ($user) {
                        return $user->toArray();
                    }, $users);
                    $response = new Response(true, HttpStatusCode::OK, "Users retrieved successfully", $userArrays);
                }
            }
            $response->encode_to_JSON();

        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "Request failed: " . $e->getMessage(), null);
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

    public function put($params = null): void
    {
        try {
            if (isset($params['userId'])) {

                $userId = $params['userId'];
                $username = $params['username'];
                $firstName = $params['first_name'];
                $lastName = $params['last_name'];

                $isAdmin = filter_var($params['is_admin'], FILTER_VALIDATE_BOOLEAN);
                $isSubscribed = filter_var($params['is_subscribed'], FILTER_VALIDATE_BOOLEAN);

                $user = $this->service->getUserById($userId);
                if ($user !== null) {
                    $user->setUsername($username);
                    $user->setFirstName($firstName);
                    $user->setLastName($lastName);
                    $user->setIsAdmin($isAdmin);
                    $user->setIsSubscribed($isSubscribed);

                    $result =$this->service->updateUser($user);
                    if ($result) {
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
        } catch (Exception $e) {
            $response = new Response(false, HttpStatusCode::BAD_REQUEST, "User update failed: " . $e->getMessage(), null);
            $response->encode_to_JSON();
        }
    }

}
