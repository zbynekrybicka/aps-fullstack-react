<?php

namespace App\Code;

use App\Code\Service;

class AjaxEvent
{

    private $title;
    private $method;
    private $url;
    private $data;
    private $authorization = true;

    private $before;
    private $after;
    private $success;
    private $error;

    private $service;

    /**
     * AjaxEvent constructor.
     * @param $title
     * @param $method
     * @param $url
     * @param $data
     */
    public function __construct($title, $method, $url, $data, $serviceClassName, $serviceMethod)
    {
        $this->title = $title;
        $this->method = $method;
        $this->url = $url;
        $this->data = $data;
        $this->service = new Service($serviceClassName, $serviceMethod);
    }

    public function noAuth() {
        $this->authorization = false;
        return $this;
    }

    public function before($title, array $content = null)
    {
        $this->before = new Reducer($title, $content);
        return $this;
    }

    public function after($title, array $content = null)
    {
        $this->after = new Reducer($title, $content);
        return $this;
    }

    public function success($title, array $content = null)
    {
        $this->success = new Reducer($title, $content);
        return $this;
    }


    public function fail($title, array $content = null)
    {
        $this->error = new Reducer($title, $content);
        return $this;
    }

    public function export() {
        return (object) [
            'title' => $this->title,
            'method' => $this->method,
            'url' => $this->url,
            'data' => $this->data,
            'authorization' => $this->authorization,
            'before' => $this->before,
            'after' => $this->after,
            'success' => $this->success,
            'error' => $this->error,
            'service' => $this->service->export()
        ];
    }

    public function service() {
        return $this->service;
    }

    public function saveItemReducer($storeItem, $storeList, $after)
    {
        $reducer = [
            'state.' . $storeList .
            '[state.' . $storeList . '.findIndex(item => state.' . $storeItem . '.id === item.id)] ' .
            '= Object.assign({}, state.' . $storeItem . ')'
        ];
        unset($this->success);
        $this->success = new Reducer($this->title . 'Success', array_merge($reducer, $after));
        return $this;
    }

}