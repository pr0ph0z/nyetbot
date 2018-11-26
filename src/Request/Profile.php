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
    
    /**
     * Get profile by LINE ID
     *
     * @param  mixed $userId
     * 
     * @since 0.1.1
     *
     * @return void
     */
    public function getProfile(string $userId = null)
    {
        $this->bot->setApi(Http::PROFILE_API);
        return $this->bot->http->get(array($userId));
    }
}