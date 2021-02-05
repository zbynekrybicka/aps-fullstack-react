<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.01.2021
 * Time: 21:17
 */

namespace App;


class Response
{
    private $code;
    private $data;

    public function __construct($code, $data) {
        $this->code = $code;
        $this->data = $data;
    }


    public function code() {
        return $this->code;
    }

    public function data() {
        return $this->data;
    }

}