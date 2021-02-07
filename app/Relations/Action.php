<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 07.02.2021
 * Time: 18:24
 */

namespace App\Relations;


use App\Meta\Template;

class Action
{
    /** @var Template $template */
    private $template;

    /** @var string $title */
    private $title;
    private $service;

    public function __construct($template, $title) {
        $this->template = $template;
        $this->title = $title;
    }

    public function request($method, $url, $data, $service, $authorization = true) {
        $this->template->action($this->title, $method, 'http://localhost:8080' . $url, $authorization, 'preloaderOn', 'preloaderOff', $this->title . 'Success', $this->title . 'Error', $data);
        $this->template->route($method, $url, $service, $this->title);
        $this->service = $service;
        return $this;
    }

    public function success($lines) {
        $reducer = $this->template->reducer($this->title . 'Success');
        foreach ($lines as $line) {
            $reducer->line($line);
        }
        return $this;
    }

    public function error($lines) {
        $reducer = $this->template->reducer($this->title . 'Error');
        foreach ($lines as $line) {
            $reducer->line($line);
        }
        return $this;
    }

    public function service() {
        return new Service($this->template, $this->service, $this->title);
    }

}