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
    private $helperComponents = [];

    /** @var array $props */
    private $props = [];


    /**
     * Component constructor.
     * @param $title
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
            'helperComponents' => $this->helperComponents,
            'content' => array_map(function (ComponentContent $content) { return $content->export(); }, $this->content)
        ];
    }


    /**
     *
     * @param object $subComponent data
     * @param Template $template
     */
    public function addContent($subComponent, Template $template)
    {
        $content = new ComponentContent($subComponent->title);
        if (isset($subComponent->attributes)) {
            $content->addAttributes($subComponent->attributes, $template, $this);
        }
        if (isset($subComponent->events)) {
            $content->addEvents($subComponent->events, $template, $this);
        }
        $this->content[] = $content;
    }


    /**
     *
     * @param string $state
     * @param string $stateKey
     */
    public function addState($state, $stateKey)
    {
        $this->state[$stateKey] = $state;
    }


    /**
     *
     * @param string $reducer
     */
    public function addReducer($reducer)
    {
        $this->reducers[] = $reducer;
    }


    /**
     * @param string $title
     */
    public function addAction($title)
    {
        $this->actions[] = $title;
    }


    /**
     * @param $title
     */
    public function addHelperComponent($title) {
        $this->helperComponents[] = $title;
    }

}