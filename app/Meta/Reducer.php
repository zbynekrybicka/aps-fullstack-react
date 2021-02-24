<?php
namespace App\Meta;


class Reducer
{

    /** @var string $title */
    private $title;


    /** @var array $content */
    private $content = [];


    /**
     * Reducer constructor.
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
            'content' => $this->content
        ];
    }

    public function line($line) {
        $this->content[] = $line;
    }

    public function getTitle()
    {
        return $this->title;
    }

}