<?php

namespace App\Meta;

class Action
{
    /** @var string $title */
    private $title;

    /** @var string $method */
    private $method;

    /** @var string $url */
    private $url;

    /** @var bool $authorization */
    private $authorization;

    /** @var string $before */
    private $before;

    /** @var string $after */
    private $after;

    /** @var string $success */
    private $success;

    /** @var string $error */
    private $error;

    /** @var string $store */
    private $store;

    /**
     * Action constructor.
     * @param string $title
     * @param $method
     * @param $url
     * @param $authorization
     * @param $before
     * @param $after
     * @param $success
     * @param $error
     * @param $store
     */
    public function __construct($title, $method, $url, $authorization, $before, $after, $success, $error, $store)
    {
        $this->title = $title;
        $this->method = $method;
        $this->url = $url;
        $this->authorization = $authorization;
        $this->before = $before;
        $this->after = $after;
        $this->success = $success;
        $this->error = $error;
        $this->store = $store;
    }

    /**
     *
     * @return object
     */
    public function export() {
        return (object) [
            'title' => $this->title,
            'method' => $this->method,
            'url' => $this->url,
            'authorization' => $this->authorization,
            'before' => $this->before,
            'after' => $this->after,
            'success' => $this->success,
            'error' => $this->error,
            'store' => $this->store
        ];
    }
}