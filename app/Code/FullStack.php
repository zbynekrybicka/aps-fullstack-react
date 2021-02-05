<?php

namespace App\Code;


use Adbar\Dot;
use App\Code\Component;

class FullStack extends Code
{

    /** @var Component[] $content  */
    private $content = [];


    /** @var object $state */
    private $state;


    /** @var object $config */
    private $config;


    /**
     * FullStack constructor.
     *
     */
    public function __construct() {
        $this->state = new Dot([]);
        $this->config = (object) [];
    }


    /**
     * @return object
     */
    public function export()
    {
        return (object) [
            'state' => $this->state->all(),
            'config' => $this->config,
            'content' => array_map(function (Component $component) { return $component->export(); }, $this->content),
        ];
    }

    public function component($title)
    {
        $component = new Component($title);
        $this->content[] = $component;
        return $component;
    }

    public function config($key, $value)
    {
        $this->config->{$key} = $value;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return FullStack
     */
    public function state($key, $value) {
        $this->state->add($key, $value);
        return $this;
    }

    public function lang($lang, $translations)
    {
        foreach ($translations as $i => $translation) {
            $this->state('lang.' . $i . '.' . $lang, $translation);
        }
        return $this;
    }
}