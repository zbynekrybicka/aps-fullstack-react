<?php

namespace App\Meta;


class ServiceMethod
{

    /** @var string $title */
    private $title;


    /** @var array $lines */
    private $lines;


    /**
     * ServiceMethod constructor.
     * @param string $title
     * @param array $lines
     */
    public function __construct($title, array $lines) {
        $this->title = $title;
        $this->lines = $lines;
    }


    /**
     *
     * @return object
     */
    public function export() {
        return (object) [
            'title' => $this->title,
            'lines' => $this->lines,
        ];
    }
}