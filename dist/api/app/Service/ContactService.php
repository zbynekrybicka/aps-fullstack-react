<?php
namespace App\Service;

use App\Request;
use App\Response;
use App\Resource\Rest;

class ContactService
{
    private $rest;

    public static function get() {
        static $contactService;
        if (!$contactService) {
            $contactService = new ContactService();
        }
        return $contactService;
    }

    public function __construct() {
        $this->rest = Rest::get();
    }

    public function putContact(Request $request) {
        return $this->rest->put('contact', $request->data());
    }

}