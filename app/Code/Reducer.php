<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.02.2021
 * Time: 8:32
 */

namespace App\Code;


class Reducer
{

    public function __construct($title, $content = null) {
        $this->title = $title;
        $this->content = $content;
    }

    public function export() {
        $result = (object) [
            'title' => $this->title
        ];
        if ($this->content) {
            $result->content = $this->content;
        }
        return $result;
    }

}