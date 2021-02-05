<?php
namespace App\Code;

class Component
{

    const MOBILE = 'mobile';
    const TABLET = 'tablet';
    const PC = 'pc';

    private static $list;

    private $title;
    private $content;
    private $attributes;
    private $events;
    private $helperComponents = [];
    private $props = [];

    public function __construct($title) {
        $this->title = $title;
        $this->style = [
            self::MOBILE => (object) [],
            self::TABLET => (object) [],
            self::PC => (object) [],
        ];
    }

    /**
     * @param $title
     * @return Component
     */
    public function component($title)
    {
        $component = new Component($title);
        $this->content[] = $component;
        return $component;
    }


    /**
     * @param $key
     * @param $value
     * @return Component
     */
    public function attribute($key, $value) {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function event($title, $params = '') {
        $event = new Event($title, '(' . $params . ')');
        $this->events[] = $event;
        return $event;
    }


    public function export()
    {
        $result = (object) [
            'title' => $this->title,
            'props' => $this->props,
            'helperComponents' => array_map(function (Component $component) { return $component->export(); }, $this->helperComponents)
        ];
        if ($this->content) {
            $result->content = array_map(function (Component $component) { return $component->export(); }, $this->content);
        }
        if ($this->attributes) {
            $result->attributes = $this->attributes;
        }
        if ($this->events) {
            $result->events = (object) [];
            $events = array_map(function (Event $event) { return $event->export(); }, $this->events);
            foreach ($events as $event) {
                foreach ((array) $event as $type => $content)
                $result->events->{$type} = (object) $content;
            }

        }
        return $result;
    }

    /**
     * @param $title
     * @param $type
     * @param $store
     * @return Component
     */
    public function input($title, $type, $store, $translations, $onEnter = null)
    {
        $input = $this->component($title)
            ->component('input')
            ->attribute('type', "'$type'")
            ->attribute('store', $store)
            ->attribute('lang', ['placeholder', $store, $translations]);
        if ($onEnter) {
            $input->attribute('onKeyDown', 'e => e.key === "Enter" && dispatch(' . $onEnter . '())');
        }
        return $this;
    }

    /**
     * @param string $title
     * @param string $method
     * @param string $url
     * @param string $data
     * @param string $serviceClassName
     * @param array $success
     * @param array $fail
     * @return AjaxEvent
     */
    public function ajaxClick($title, $method, $url, $data, $serviceClassName, $success, $fail)
    {
        return $this->event('click')
            ->ajax($title, $method, $url, $data, $serviceClassName, $title)
            ->before('preloaderOn', [ 'state.preloader = true' ])
            ->after('preloaderOff', [ 'state.preloader = false' ])
            ->success($title . 'Success', $success)
            ->fail($title . 'Error', $fail);

    }


    /**
     * @param $component
     * @param $langStore
     * @param $translations
     * @return Component
     */
    public function button($component, $langStore, $translations, $class, $prop = null)
    {
        $button = $this->component($component);
        if ($prop) {
            $button->attribute($prop, $prop);
            $button->prop($prop);
        }
        return $button->component('button')
            ->attribute('className', "'$class'")
            ->attribute('lang', ['text', $langStore, $translations]);

    }


    /**
     * @param $title
     * @param $reducer
     */
    public function clickReducer($title, $reducer, $params = '')
    {
        $this->event('click', $params)
            ->reducer($title, $reducer);
    }

    /**
     * @param $component
     * @param $store
     * @param $translations
     * @return Component
     */
    public function checkbox($component, $store, $translations)
    {
        $container = $this->component($component);
        $checkbox = $container->component('input');

        $checkboxId = "'" . $component . "CheckboxId'";
        $checkbox->attribute('type', "'checkbox'")
            ->attribute('checked', 'state.' . $store)
            ->attribute('id', $checkboxId)
            ->event('change', 'e.target.checked')
            ->reducer($component . 'Checked', [ 'state.' . $store . ' = action.payload' ]);

        $container->component('label')
            ->attribute('lang', ['text', $store, $translations])
            ->attribute('htmlFor', $checkboxId);

        return $this;
    }

    public function select($component, $store, $values, $value = 'i', $label = 'item')
    {
        $values = str_replace('lang.', 'state.lang[state.activeLang].', $values);
        $options = 'typeof ' . $values . ' === \'object\'' .
            '? Object.entries(' . $values . ').map(([i, item]) => <option key={i} value={' . $value . '}>{' . $label . '}</option>) ' .
            ': ' . $values . '.map(([i, item]) => <option key={i} value={' . $value . '}>{' . $label . '}</option>)';
        $this->component($component)
            ->component('select')
            ->attribute('store', $store)
            ->attribute('text', $options);

        return $this;
    }

    /**
     * @param $component
     * @param $store
     * @return Component
     */
    public function listComponent($component, $store)
    {
        $store = str_replace('lang.', 'state.lang[state.activeLang].', $store);
        $list = $this->component($component)
            ->component('div')
            ->attribute('className', "'list'")
            ->attribute('text', $store . '.map((item, i) => <' . $component . 'Container key={\'' . $component . '\' + i} item={item} />)')
            ->helperComponent($component . 'Container')
            ->prop('item')
            ->component('div')
            ->attribute('className', "'list-row'");
        self::$list = $list;
        return $list->attribute('text', '<' . $component . 'List item={item} />')
            ->helperComponent($component . 'List')
            ->prop('item');
    }


    /**
     * @return Component
     */
    public function listContainer() {
        return self::$list;
    }

    public function helperComponent($title)
    {
        $component = new Component($title);
        $this->helperComponents[] = $component;
        return $component;
    }

    public function prop($title)
    {
        $this->props[] = $title;
        return $this;
    }

    /**
     * @param $component
     * @return Component
     */
    public function listItem($component)
    {
        return $this->component($component)
            ->attribute('item', 'item')
            ->prop('item');
    }

    /**
     * @param $component
     * @param $expression
     * @return Component
     */
    public function listItemText($component, $expression)
    {
        $this->component($component)
            ->attribute('item', 'item')
            ->prop('item')
            ->component('div')
            ->attribute('text', $expression)
            ->attribute('className', "'list-cell'");
        return $this;
    }

    public function text($expression)
    {
        $this->component('div')
            ->attribute('text', $expression);
        return $this;
    }

    public function reducerButton($title, $langStore, $translations, $class, $reducer)
    {
        $this->button($title, $langStore, $translations, $class)
            ->clickReducer($title . 'Reducer', $reducer);
        return $this;
    }

    /**
     * @param $element
     * @param $lang
     * @return Component
     */
    public function langElement($element, $lang)
    {
        $this->component($element)
            ->attribute('lang', $lang);
        return $this;
    }

    public function saveItemButton($component, $store)
    {
        $this->button($component. 'Save', 'selected' . $component . '.save', ['Uložit', 'Save'], 'green')
        ->ajaxClick('put' . $component, 'put', '/' . lcfirst($component), 'selected' . $component, lcfirst($component), [], [])
        ->saveItemReducer('selected' . $component, $store, ['state.selected' . $component. '.id = null'])
        ->service()
        ->resource('rest', 'Rest')
        ->restMethod('put', lcfirst($component));

    }


}