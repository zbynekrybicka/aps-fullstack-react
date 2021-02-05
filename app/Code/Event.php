<?php

namespace App\Code;


class Event
{
    private $title;

    /** @var Reducer */
    private $reducer;

    /** @var AjaxEvent $ajax */
    private $ajax;

    /** @var string $params */
    private $params;

    public function __construct($title, $params) {
        $this->title = $title;
        $this->params = $params;
    }

    public function export() {
        if ($this->ajax) {
            return (object) [
                $this->title => [
                    'ajax' => $this->ajax->export(),
                    'params' => $this->params,
                ]
            ];
        }
        if ($this->reducer) {
            return (object) [
                $this->title => [
                    'reducer' => $this->reducer->export(),
                    'params' => $this->params,
                ]
            ];
        }
    }

    public function ajax($title, $method, $url, $data, $serviceClassName, $serviceMethod)
    {
        $this->ajax = new AjaxEvent($title, $method, $url, $data, $serviceClassName, $serviceMethod);
        return $this->ajax;
    }

    public function reducer($title, $reducer)
    {
        $this->reducer = new Reducer($title, $reducer);
    }
}