<?php

namespace Nyetbot\Request;

/**
 * Group class based on Request
 * 
 * @package \Nyetbot\Request
 */
class Group {
    
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

    public function getMemberId(string $groupId): string
    {
        $this->bot->setApi(Http::GROUP_API);

        return $this->bot->http->get(array($groupId));
    }
}