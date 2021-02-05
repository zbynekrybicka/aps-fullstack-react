<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.02.2021
 * Time: 8:39
 */

namespace App\Code;


class Service
{
    private $title;
    private $method;
    private $resources = [];
    private $content = [];

    public function __construct($title, $method)
    {
        $this->title = $title;
        $this->method = $method;
    }

    public function export() {
        $result = (object) [
            'title' => $this->title,
            'method' => (object) [
                'title' => $this->method
            ]
        ];
        if ($this->resources) {
            $result->resources = $this->resources;
        }
        if ($this->content) {
            $result->method->content = $this->content;
        }
        return $result;
    }

    /**
     * @param $attribute
     * @param $className
     * @return Service
     */
    public function resource($attribute, $className)
    {
        $this->resources[$attribute] = $className;
        return $this;
    }

    public function method(array $content) {
        $this->content = $content;
    }

    public function restMethod($method, $table)
    {
        $this->method([ 'return $this->rest->' . $method . '(\'' . $table . '\', $request->data());']);
    }

}