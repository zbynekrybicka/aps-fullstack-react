<?php
namespace App\Service;

use App\Request;
use App\Response;
use App\Resource\UserAuth;

class AuthService
{
    private $userAuth;

    public static function get() {
        static $authService;
        if (!$authService) {
            $authService = new AuthService();
        }
        return $authService;
    }

    public function __construct() {
        $this->userAuth = UserAuth::get();
    }

    public function postLogin(Request $request) {
        return $this->userAuth->login($request);
    }

}