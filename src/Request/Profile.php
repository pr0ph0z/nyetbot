<?php

namespace Nyetbot\Request;

/**
 * Message class based on Request
 * 
 * @package \Nyetbot\Request
 */
class Profile
{
    /**
     * construct
     *
     * @param  mixed $parent
     *
     * @return void
     */
    public function __construct($parent)
    {
        $this->bot = $parent;
    }
    
    /**
     * getProfile
     *
     * @param  mixed $userId
     *
     * @return void
     */
    public function getProfile(string $userId = null)
    {
        $this->bot->setApi(Http::PROFILE_API);
        return $this->bot->http->get(array($userId));
    }
}