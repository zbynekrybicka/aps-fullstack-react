<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 05.02.2021
 * Time: 15:34
 */

namespace App\Resource;


use App\Request;
use App\Response;

class UserAuth
{

    public static function get()
    {
        static $authService;
        if (!$authService) {
            $authService = new UserAuth();
        }
        return $authService;
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
            'user' => ['id' => $user->id, 'role' => $user->role ],
            'appData' => $this->loadAppData($user),
        ];
    }

    private function loadAppData($user)
    {
        switch ($user->role) {
            case 1:

                return [ 'operator' => [] ];

            case 2:

                return [ 'manager' => [
                        'contact' => $this->db->select('*')->from('contact')->fetchAll(),
                        'campaign' => $this->db->select('*')->from('campaign')->fetchAll(),
                        'call' => $this->db->select('*')->from('call')->fetchAll(),
                    ]
                ];
        }
    }
}