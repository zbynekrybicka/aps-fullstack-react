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
     * @param object $content
     */
    public function __construct($title, $content)
    {
        $this->title = $title;
        $this->method = $content->method;
        $this->url = Config::$config->apiUrl . $content->url;
        $this->store = $content->data;
        $this->authorization = $content->authorization;
        $this->before = $content->before->title;
        $this->after = $content->after->title;
        $this->success = $content->success->title;
        $this->error = $content->error->title;
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