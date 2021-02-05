<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 01.02.2021
 * Time: 9:50
 */

namespace App\Meta;


class Style
{

    private $style;

    public function __construct() {

    }

    public function addStyle($component, $style) {
        $this->style[$component] = $style;
    }

    public function export() {
        $result = [];
        foreach ($this->style as $component => $style) {
            if (get_object_vars($style->mobile) || get_object_vars($style->tablet) || get_object_vars($style->pc)) {
                $result[$component] = $style;
            }
        }
        return (object) $result;
    }

}