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

    /**
     * Get member IDs in room. This feature only available for LINE@ Approved accounts
     *
     * @param  mixed $roomId
     * 
     * @since 0.2.2
     *
     * @return string
     */
    public function getMemberId(string $roomId): string
    {
        $this->bot->setApi(Http::ROOM_MEMBER_ID_API);

        return $this->bot->http->get(array($roomId));
    }

    /**
     * Get member profile in room.
     *
     * @param  mixed $roomId
     * @param  mixed $userId
     * 
     * @since 0.2.2
     *
     * @return string
     */
    public function getMemberProfile(string $roomId, string $userId): string
    {
        $this->bot->setApi(Http::ROOM_MEMBER_PROFILE_API);

        return $this->bot->http->get(array($roomId, $userId));
    }
}