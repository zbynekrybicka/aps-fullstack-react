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

    public function attribute($key, $value)
    {
        $this->attributes->{$key} = $value;
    }

    public function open($open)
    {
        $this->open = $open;
    }

    public function close($close) {
        $this->close = $close;
    }

    public function content($content) {
        $this->close('>{' . $content . '}</' . $this->title . '>');
    }

    public function condition($condition)
    {
        $this->open('{(' . $condition . ') && ');
        $this->close('/>}');
    }

}