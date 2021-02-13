<?php

namespace App\Meta;


use Adbar\Dot;

class State
{
    /** @var Dot $state */
    private $state;


    /**
     * State constructor.
     */
    public function __construct() {
        $this->state = new Dot([]);
    }


    /**
     *
     * @return array
     */
    public function export() {
        return $this->state->all();
    }


    /**
     *
     * @param string $state
     * @param string $value
     */
    public function add($state, $value)
    {
        if (!$this->state->has($state)) {
            $this->state->add($state, $value);
        }
    }

}