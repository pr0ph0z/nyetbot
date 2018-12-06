<?php

namespace Nyetbot\Request;

/**
 * Room class based on Request
 * 
 * @package \Nyetbot\Request
 */
class Room {
    
    /**
     * Constructor
     *
     * @param  mixed $parent
     *
     * @return void
     */
    public function __construct($parent)
    {
        $this->bot = $parent;
    }
}