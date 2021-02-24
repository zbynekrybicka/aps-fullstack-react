<?php
/**
 * Created by PhpStorm.
 * User: zbyne
 * Date: 07.02.2021
 * Time: 18:03
 */

namespace App\Relations;


use App\Aps;

class FullStack
{
    private $template;

    public function __construct() {
        $this->aps = new Aps();
        $this->template = $this->aps->template();
    }

    /**
     * @param $title
     * @return Component
     */
    public function component($title) {
        return new Component($this->template, ucfirst($title));
    }

    public function execute() {
        $this->aps->execute();
    }


    /**
     * @param $state
     * @param $defaultValue
     * @return FullStack
     */
    public function state($state, $defaultValue)
    {
        $this->template->state($state, $defaultValue);
        return $this;
    }

}