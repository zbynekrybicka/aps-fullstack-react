<?php

namespace App\Meta;


class Component
{
    /** @var string $title */
    private $title;


    /** @var array $state */
    private $state = [];


    /** @var array $reducers */
    private $reducers = [];


    /** @var ComponentContent[] $content */
    private $content = [];


    /** @var array $actions */
    private $actions = [];

    /** @var array $helperComponents */
    private $components = [];

    /** @var array $props */
    private $props = [];


    /**
     * Component constructor.
     * @param $title
     * @param $props
     */
    public function __construct($title, $props) {
        $this->title = $title;
        $this->props = $props;
    }


    /**
     *
     * @return object
     */
    public function export() {
        return (object) [
            'title' => $this->title,
            'state' => $this->state,
            'reducers' => $this->reducers,
            'actions' => $this->actions,
            'props' => $this->props,
            'components' => $this->components,
            'content' => array_map(function (ComponentContent $content) { return $content->export(); }, $this->content)
        ];
    }


    /**
     *
     * @param $title
     * @return ComponentContent
     */
    public function content($title)
    {
        $content = new ComponentContent($title);
        $this->content[] = $content;
        return $content;
    }


    /**
     *
     * @param string $stateKey
     * @param string $state
     */
    public function state($stateKey, $state)
    {
        $this->state[$stateKey] = $state;
    }


    /**
     *
     * @param string $title
     */
    public function reducer($title)
    {
        $this->reducers[] = $title;
    }


    /**
     * @param string $title
     */
    public function action($title)
    {
        $this->actions[] = $title;
    }


    /**
     * @param $title
     */
    public function component($title) {
        $this->components[] = $title;
    }


}