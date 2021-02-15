<?php
namespace App\Service;

use App\Request;
use App\Response;
use App\Resource\UserAuthResource;

class UserAuthService
{
    private $userAuth;

    public static function get() {
        static $self;
        if (!$self) {
            $self = new self();
        }
        return $self;
    }

    public function __construct() {
        $this->userAuth = UserAuthResource::get();
    }

    public function postLogin(Request $request) {
        return $this->userAuth->login($request); 
    }

}