<?php

namespace App\Meta;


class Route
{

    /** @var string $method */
    private $method;


    /** @var string $url */
    private $url;


    /** @var string $serviceClassName */
    private $serviceClassName;


    /** @var string $serviceMethod */
    private $serviceMethod;


    /**
     * Route constructor.
     * @param object $content
     */
    public function __construct($content)
    {
        $this->method = $content->method;
        $this->url = $content->url;
        $this->serviceClassName = $content->service->title;
        $this->serviceMethod = $content->service->method->title;
    }


    /**
     *
     * @return object
     */
    public function export() {
        return (object) [
            'method' => $this->method,
            'url' => $this->url,
            'service' => (object) [
                'className' => $this->serviceClassName,
                'method' => $this->serviceMethod,
            ]
        ];
    }

}