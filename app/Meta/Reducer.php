<?php
namespace App\Meta;


class Reducer
{

    /** @var string $title */
    private $title;


    /** @var array $content */
    private $content;


    /**
     * Reducer constructor.
     * @param string $title
     * @param array $content
     */
    public function __construct($title, array $content) {
        $this->title = $title;
        $this->content = $content;
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

    public function getTitle()
    {
        return $this->title;
    }

}