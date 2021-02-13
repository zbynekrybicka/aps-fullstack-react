<?php
namespace App\Meta;


class Template
{

    /** @var Component[] */
    private $components = [];

    /** @var Reducer[]  */
    private $reducers = [];

    /** @var State $state */
    private $state;

    /** @var Action[]  */
    private $actions = [];

    /** @var Route[]  */
    private $routes = [];

    /** @var Service[]  */
    private $services = [];


    public function __construct() {
        $this->state = new State();
    }

    /**
     *
     * @return object
     */
    public function export() {
        return (object) [
            'components' => array_map(function (Component $component) { return $component->export(); }, $this->components),
            'reducers' => array_map(function (Reducer $reducer) { return $reducer->export(); }, $this->reducers),
            'state' => $this->state->export(),
            'actions' => array_map(function (Action $action) { return $action->export(); }, $this->actions),
            'routes' => array_map(function (Route $route) { return $route->export(); }, $this->routes),
            'services' => array_map(function (Service $service) { return $service->export(); }, $this->services),
        ];
    }

    public function component($title, $props = [])
    {
        $component = new Component($title, $props);
        $this->components[] = $component;
        return $component;
    }

    public function reducer($title)
    {
        $reducer = new Reducer($title);
        $this->reducers[] = $reducer;
        return $reducer;

    }

    public function action($title, $method, $url, $authorization, $before, $after, $success, $error, $store)
    {
        $action = new Action($title, $method, $url, $authorization, $before, $after, $success, $error, $store);
        $this->actions[] = $action;

    }

    public function route($method, $url, $serviceClassName, $serviceMethod)
    {
        $route = new Route((object) [
            'method' => $method,
            'url' => $url,
            'serviceClassName' => $serviceClassName,
            'serviceMethod' => $serviceMethod,
        ]);
        $this->routes[] = $route;
        return $route;
    }


    /**
     * @param $title
     * @return Service
     */
    public function service($title)
    {
        $service = new Service($title);
        $this->services[] = $service;
        return $service;
    }


    /**
     * @param $path
     * @param $value
     */
    public function state($path, $value) {
        $this->state->add($path, $value);
    }


}