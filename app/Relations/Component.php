<?php
namespace App\Relations;


use App\Meta\Component as MetaComponent;
use App\Meta\Template;

class Component
{

    private $template;

    /** @var MetaComponent */
    private $component = null;
    private $title;
    private $initialAction = null;

    /**
     * Component constructor.
     * @param Template $template
     * @param string $title
     */
    public function __construct($template, $title) {
        $this->template = $template;
        $this->title = $title;
    }

    public function state($variable, $path, $defaultValue) {
        $this->initComponent();
        $this->component->state($variable, 'state.data.' . $path);
        $this->template->state($path, $defaultValue);
    }

    public function reducer($title, $lines = []) {
        $this->initComponent();
        $this->component->reducer($title);
        if ($lines) {
            $reducer = $this->template->reducer($title);
            foreach ($lines as $line) {
                $reducer->line($line);
            }
        }
    }

    public function action($title) {
        $this->initComponent();
        $this->component->action($title);
        return new Action($this->template, $title);
    }

    public function component($title) {
        $this->initComponent();
        $this->component->component(ucfirst($title));
        return new Component($this->template, ucfirst($title));
    }

    public function content($title) {
        $this->initComponent();
        return new ComponentContent($this, $this->template, $this->component, $title);
    }

    private function initComponent()
    {
        if (!$this->component) {
            $this->component = $this->template->component($this->title);
        }
    }

    /**
     * @param $title
     * @return ComponentContent
     */
    public function subComponent($title)
    {
        $this->initComponent();
        $this->component->component($title);
        return $this->content($title);
    }

    public function initialAction($title)
    {
        $this->initComponent();
        $this->component->initialAction($title);
        return $this->action($title);
    }


}