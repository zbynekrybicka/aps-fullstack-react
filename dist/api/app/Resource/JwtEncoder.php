<?php

namespace App\Resource;


use Firebase\JWT\JWT;

class JwtEncoder
{
    const JWT_KEY = 'your-256-bit-secret';

    public static function get() {
        static $jwtEncoder = null;
        if (!$jwtEncoder) {
            $jwtEncoder = new JwtEncoder();
        }
        return $jwtEncoder;

    }

    public function encode($user) {
        return JWT::encode([
            'id' => $user->id,
            'role' => $user->role
        ], self::JWT_KEY);
    }
}