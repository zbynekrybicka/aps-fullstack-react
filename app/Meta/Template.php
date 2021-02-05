<?php
namespace App\Meta;


class Template
{

    private $meta;

    /** @var Component[] */
    private $components = [];

    /** @var Reducer[]  */
    private $reducers = [];

    /** @var  State */
    private $state;

    /** @var Action[]  */
    private $actions = [];

    /** @var Route[]  */
    private $routes = [];

    /** @var Service[]  */
    private $services = [];

    /** @var string[] */
    private $mf = [];

    /**
     * Template constructor.
     * @param $meta
     */
    public function __construct($meta)
    {
        $this->meta = $meta;
        $this->translate();
    }


    /**
     *
     * @return object
     */
    public function export() {
        $this->reducersFilter();
        return (object) [
            'components' => array_map(function (Component $component) { return $component->export(); }, $this->components),
            'reducers' => array_map(function (Reducer $reducer) { return $reducer->export(); }, $this->reducers),
            'state' => $this->state->export(),
            'actions' => array_map(function (Action $action) { return $action->export(); }, $this->actions),
            'routes' => array_map(function (Route $route) { return $route->export(); }, $this->routes),
            'services' => array_map(function (Service $service) { return $service->export(); }, $this->services),
        ];
    }


    /**
     *
     */
    private function translate()
    {
        $this->state = new State($this->meta->state);
        Config::load($this->meta->config);
        $this->loadSubcomponents($this->meta->content);
    }


    /**
     *
     * @param array $content
     * @param Component|null $component
     */
    private function loadSubcomponents(array $content, Component $component = null)
    {
        foreach ($content as $subComponent) {
            if ($component) {
                $this->loadSubComponents($subComponent->helperComponents);
                foreach ($subComponent->helperComponents as $helperComponent) {
                    $component->addHelperComponent($helperComponent->title);
                }
                $component->addContent($subComponent, $this);
            }
            if ($subComponent->title === ucfirst($subComponent->title)) {
                $newComponent = $this->loadComponent($subComponent);
                if (isset($subComponent->content)) {
                    $this->loadSubcomponents($subComponent->content, $newComponent);
                }
            }
        }
    }


    /**
     *
     * @param object $component
     * @return Component
     */
    private function loadComponent($component)
    {
        $newComponent = new Component($component->title, $component->props);
        $this->components[] = $newComponent;
        return $newComponent;
    }


    /**
     *
     * @param string $state
     * @param mixed $value
     */
    public function addState($state, $value)
    {
        $this->state->add($state, $value);
    }


    /**
     *
     * @param string $title
     * @param array $content
     */
    public function addReducer($title, array $content)
    {
        $reducer = new Reducer($title, $content);
        $this->reducers[] = $reducer;
    }


    /**
     *
     * @param string $title
     * @param object $content
     */
    public function addAction($title, $content)
    {
        $action = new Action($title, $content);
        $this->actions[] = $action;
    }


    /**
     *
     * @param object $content
     */
    public function addRoute($content)
    {
        $route = new Route($content);
        $this->routes[] = $route;
    }


    /**
     *
     * @param object $data
     */
    public function addServiceMethod($data)
    {
        $service = $this->getService($data->title, isset($data->resources) ? $data->resources : (object) []);
        $service->addMethod($data->method);
    }


    /**
     *
     * @param object $service
     */
    public function addMf($service)
    {
        $this->mf[] = $service->title;
    }


    /**
     * @param string $title
     * @param object $resources
     * @return Service
     */
    private function getService($title, $resources)
    {
        foreach ($this->services as $service) {
            if ($service->isTitle($title)) {
                return $service;
            }
        }
        $service = new Service($title, $resources);
        $this->services[] = $service;
        return $service;
    }

    private function reducersFilter()
    {
        $reducers = [];
        foreach ($this->reducers as $reducer) {
            $reducers[ $reducer->getTitle() ] = $reducer;
        }
        $this->reducers = $reducers;
    }


}