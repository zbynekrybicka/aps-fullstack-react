<?php

namespace App\Meta;


class Service
{
    /** @var string $title */
    private $title;


    /** @var ServiceMethod[] $methods */
    private $methods = [];


    /** @var array $resources */
    private $resources = [];

    /**
     * Service constructor.
     * @param string $title
     */
    public function __construct($title) {
        $this->title = $title;
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
     *
     * @param $title
     * @return ServiceMethod
     */
    public function method($title)
    {
        $method = new ServiceMethod($title);
        $this->methods[] = $method;
        return $method;
    }


    /**
     * @param $attribute
     * @param $resource
     */
    public function resource($attribute, $resource) {
        $this->resources[$attribute] = $resource;
    }

}