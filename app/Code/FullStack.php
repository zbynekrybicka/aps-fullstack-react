<?php

namespace App\Code;


use App\Aps;
use App\Meta\Template;

class FullStack
{

    /** @var Aps $aps */
    private $aps;

    /** @var Template  */
    private $template;

    public function __construct() {
        $this->aps = new Aps();
        $this->template = $this->aps->template();
    }


    public function execute()
    {
        $this->aps->execute();
    }
}