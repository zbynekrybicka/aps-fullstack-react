<?php
namespace App\Resource;


use App\Request;
use App\Response;

class UserAuthResource
{

    public static function get() {
        static $self;
        if (!$self) {
            $self = new self();
        }
        return $self;
    }

    private function __construct()
    {
        $this->db = DbConnection::get();
        $this->jwt = JwtEncoder::get();
    }

    public function login(Request $request)
    {
        $user = $this->db->select('*')->from('user')->where('username = %s', $request->data()->username)->fetch();
        if (!$user) return new Response(400, 'userNotFound');
        if (!password_verify($request->data()->password, $user->password)) return new Response(400, 'badPassword');

        return new Response(200, $this->loadResponseData($user));
    }

    private function loadResponseData($user)
    {
        return [
            'authToken' => $this->jwt->encode($user),
            'user' => ['id' => $user->id, 'role' => $user->role ]
        ];
    }

}