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
     */
    public function __construct($title) {
        $this->title = $title;
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

    public function line($line) {
        $this->lines[] = $line;
    }
}