<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 07.02.2021
 * Time: 18:32
 */

namespace App\Relations;


use App\Meta\Template;

class Service
{

    /** @var Template $template */
    private $template;
    private $service;
    private $method;

    private $resources = [];

    public function __construct($template, $service, $method) {
        $this->template = $template;
        $this->service = $service;
        $this->method = $method;
    }

    /**
     * @param $attribute
     * @param $resource
     * @return Service
     */
    public function resource($attribute, $resource) {
        $this->resources[$attribute] = $resource;
        return $this;
    }

    public function method($lines) {
        $service = $this->template->service($this->service);
        $method = $service->method($this->method);
        foreach ($this->resources as $attribute => $resource) {
            $service->resource($attribute, $resource);
        }
        foreach ($lines as $line) {
            $method->line($line);
        }
    }
}