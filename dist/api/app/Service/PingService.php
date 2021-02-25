<?php
namespace App\Service;

use App\Request;
use App\Response;

class PingService
{

    public static function get() {
        static $self;
        if (!$self) {
            $self = new self();
        }
        return $self;
    }

    public function __construct() {
    }

    public function ping(Request $request) {
        return new Response(200, 'connection active');
    }

}