<?php

namespace App\Relations;

use App\Meta\Component as MetaComponent;
use App\Meta\ComponentContent as MetaContent;
use App\Meta\Template;

class ComponentContent
{

    /** @var Template $template */
    private $template;

    /** @var Component  */
    private $component;

    /** @var MetaContent $metaContent */
    private $metaContent;

    /** @var MetaComponent $metaComponent */
    private $metaComponent;


    public function __construct(Component $component, Template $template, MetaComponent $metaComponent, $title) {
        $this->template = $template;
        $this->component = $component;
        $this->metaComponent = $metaComponent;
        $this->metaContent = $this->metaComponent->content($title);
    }


    /**
     * @param $attribute
     * @param $value
     * @return ComponentContent
     */
    public function attribute($attribute, $value) {
        $this->metaContent->attribute($attribute, "'$value'");
        return $this;
    }


    /**
     * @param $attribute
     * @param $variable
     * @param $state
     * @param string $defaultValue
     * @return ComponentContent
     */
    public function state($attribute, $variable, $state = '', $defaultValue = '') {
        if ($state) {
            $this->metaComponent->state($variable, 'state.data.' . $state);
            $this->template->state($state, $defaultValue);
        }
        $this->metaContent->attribute($attribute, $variable);
        return $this;
    }

    public function eventReducer($type, $reducer, $lines = [], $params = 'e.target.value') {
        $this->metaComponent->reducer($reducer);
        $this->metaContent->attribute('on' . ucfirst($type), 'e => dispatch(' . $reducer . '(' . $params . '))');
        if ($lines) {
            $templateReducer = $this->template->reducer($reducer);
            foreach ($lines as $line) {
                $templateReducer->line($line);
            }
        }
    }

    public function eventAction($type, $action) {
        $this->metaComponent->action($action);
        $this->metaContent->attribute('on' . ucfirst($type), '() => dispatch(' . $action . '())');
        return new Action($this->template, $action);
    }


    /**
     * @param $condition
     * @param string $variable
     * @param string $state
     * @param bool $defaultValue
     * @return ComponentContent
     */
    public function condition($condition, $variable = '', $state = '', $defaultValue = false) {
        $this->metaContent->open('{' . $condition . ' && ');
        $this->metaContent->close(' />}');
        if ($variable && $state) {
            $this->component->state($variable, $state, $defaultValue);
        }
        return $this;
    }

    /**
     * @param $variable
     * @param $state
     * @return ComponentContent
     */
    public function vModel($variable, $state) {
        $this->state('defaultValue', $variable, str_replace('state.', 'state.data.', $state));
        $this->eventReducer('input', 'set' . ucfirst($variable), [' state.' . $state . ' = action.payload' ]);
        return $this;
    }


    /**
     * @return Component
     */
    public function endContent()
    {
        return $this->component;
    }


    /**
     * @param $content
     * @return ComponentContent
     */
    public function content($content)
    {
        $this->metaContent->content("'$content'");
        return $this;
    }

    public function stateContent($variable, $state)
    {
        $this->metaContent->content($variable);
        $this->component->state($variable, $state, '');
        return $this;
    }

}