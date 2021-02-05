<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 31.01.2021
 * Time: 13:18
 */

namespace App\Meta;


class Service
{
    /** @var string $title */
    private $title;


    /** @var ServiceMethod[] $methods */
    private $methods = [];


    /**
     * Service constructor.
     * @param string $title
     * @param object $resources
     */
    public function __construct($title, $resources) {
        $this->title = $title;
        $this->resources = $resources;
    }


    /**
     *
     * @return object
     */
    public function export() {
        return (object) [
            'title' => $this->title,
            'resources' => $this->resources,
            'methods' => array_map(function (ServiceMethod $method) { return $method->export(); }, $this->methods),
        ];
    }


    /**
     * @param string $title
     * @return bool
     */
    public function isTitle($title)
    {
        return $this->title == $title;
    }


    /**
     *
     * @param object $data
     */
    public function addMethod($data)
    {
        $method = new ServiceMethod($data->title, $data->content);
        $this->methods[] = $method;
    }

}