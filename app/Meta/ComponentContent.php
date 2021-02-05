<?php

namespace App\Meta;


class ComponentContent
{

    /** @var string $title */
    private $title;


    /** @var object $attributes */
    private $attributes;


    /** @var string $open */
    private $open = '';


    /** @var string $close */
    private $close = ' />';


    /**
     * ComponentContent constructor.
     * @param string $title
     */
    public function __construct($title) {
        $this->title = $title;
        $this->attributes = (object) [];
    }


    /**
     *
     * @return object
     */
    public function export() {
        return (object) [
            'title' => $this->title,
            'attributes' => $this->attributes,
            'open' => $this->open,
            'close' => $this->close
        ];
    }


    /**
     *
     * @param object $attributes
     * @param Template $template
     * @param Component $component
     */
    public function addAttributes($attributes, Template $template, Component $component)
    {
        /**
         * @var string $attribute
         * @var mixed $value
         */
        foreach ((array) $attributes as $attribute => $value) {

            /** Attribute lang set one attribute with value from store.lang */
            if ($attribute == 'lang') {
                if (array_key_exists(2, $value) && $value[2]) {
                    foreach ($value[2] as $i => $translation) {
                        $template->addState('lang.' . $i . '.' . $value[1], $translation);
                    }
                }
                $stateKey = explode('.', $value[1]);
                $stateKey = implode(array_map('ucfirst', $stateKey)) . 'Lang';
                $component->addState('state.data.lang[state.data.activeLang].' . $value[1], $stateKey);
                $attribute = $value[0];
                $value = $stateKey;
            }

            /** Attribute store set defaultValue and onInput event connected to store */
            if ($attribute == 'store') {
                list($beginValue) = explode('(', $value);
                $stateKey = explode('.', $beginValue);
                $stateKey = 'lang' . implode(array_map('ucfirst', $stateKey));
                $this->attributes->defaultValue = $stateKey;
                $this->attributes->onInput = 'e => dispatch(set' . $stateKey . '(e.target.value))';
                $template->addState($value, '');
                $template->addReducer('set' . $stateKey, ["state.$value = action.payload"]);
                $component->addState('state.data.' . $value, $stateKey);
                $component->addReducer('set' . $stateKey);

            /** Attribute if set condition for show or no show */
            } else if ($attribute == 'if') {
                $condition = $this->transformStore($value, $template, $component);
                $this->open = '{' . $condition . ' && ';
                $this->close = '/>}';

            /** Attribute text set content of HTML element. Only expression, not subElements */
            } else if ($attribute == 'text') {
                $this->close = '>{' . $this->transformStore($value, $template, $component) . '}</' . $this->title . '>';

            /** Another attribute */
            } else {
                $this->attributes->{$attribute} = $this->transformStore($value, $template, $component);
            }
            $this->getReducerFromValue($value, $component);
        }
    }


    /**
     *
     * @param object $events
     * @param Template $template
     * @param Component $component
     */
    public function addEvents($events, Template $template, Component $component)
    {
        /**
         * @var string $event
         * @var object $content
         */
        foreach ((array) $events as $event => $content) {

            /** Event calls reducer */
            if (isset($content->reducer)) {
                $component->addReducer($content->reducer->title);
                $template->addReducer($content->reducer->title, $content->reducer->content);
                $this->attributes->{'on' . ucFirst($event)} = 'e => dispatch(' . $content->reducer->title . $content->params . ')';
            }

            /** Event calls ajax */
            if (isset($content->ajax)) {
                $template->addAction($content->ajax->title, $content->ajax);
                $template->addRoute($content->ajax);
                if (isset($content->ajax->service->method->content)) {
                    $template->addServiceMethod($content->ajax->service);
                }
                $template->addMf($content->ajax->service);
                $component->addAction($content->ajax->title);
                $this->addAjaxReducers($content->ajax, $template);
                $this->attributes->{'on' . ucFirst($event)} = 'e => dispatch(' . $content->ajax->title . $content->params . ')';
            }
        }
    }


    /**
     *
     * @param object $ajax
     * @param Template $template
     */
    private function addAjaxReducers($ajax, Template $template)
    {
        /** Reducer before call request */
        if (isset($ajax->before->content)) {
            $template->addReducer($ajax->before->title, $ajax->before->content);
        }

        /** Reducer after call request */
        if (isset($ajax->after->content)) {
            $template->addReducer($ajax->after->title, $ajax->after->content);
        }

        /** Reducer if request is success */
        if (isset($ajax->success->content)) {
            $template->addReducer($ajax->success->title, $ajax->success->content);
        }

        /** Reducer if request is fail */
        if (isset($ajax->error->content)) {
            $template->addReducer($ajax->error->title, $ajax->error->content);
        }
    }


    /**
     *
     * @param string $value
     * @param Template $template
     * @param Component $component
     * @return string
     */
    private function transformStore($value, Template $template, Component $component)
    {
        if (preg_match_all('/state\.((\w|\.)+)/', $value, $result)) {
            $keys = [];
            $replace = [];
            foreach ($result[1] as $state) {
                list($beginState) = explode('(', $state);
                $stateKey = explode('.', $beginState);
                $stateKey = implode(array_map('ucfirst', $stateKey));
                if (strpos($state, '.map')) {
                    $state = str_replace('.map', '', $state);
                    $template->addState($state, []);
                } else {
                    $template->addState($state, null);
                }
                $component->addState('state.data.' . $state, $stateKey);
                $keys[] = 'state.' . $state;
                $replace[] = $stateKey;
            }
            return str_replace($keys, $replace, $value);
        } else {
            return $value;
        }
    }

    private function getReducerFromValue($value, Component $component)
    {
        if (preg_match('/dispatch\((\w+)/', $value, $result)) {
            $component->addAction($result[1]);
        }
    }
}