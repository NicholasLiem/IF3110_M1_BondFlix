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


}
