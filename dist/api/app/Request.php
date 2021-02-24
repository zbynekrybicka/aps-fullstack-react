<?php
namespace App;

use App\Resource\JwtEncoder;
use Firebase\JWT\JWT;

class Request
{
    private $user = null;

    public function __construct($headers, $vars, $data)
    {
        if (array_key_exists('Authorization', $headers)) {
            $this->user = JWT::decode($headers['Authorization'], JwtEncoder::JWT_KEY, ['HS256']);
        }
        $this->vars = (object) $vars;
        $this->data = (object) $data;
    }

    public function user() {
        return $this->user;
    }

    public function vars() {
        return $this->vars;
    }

    public function data() {
        return $this->data;
    }

}