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

    /**
     * Get member IDs in group. This feature only available for LINE@ Approved accounts
     *
     * @param  mixed $groupId
     *
     * @return string
     */
    public function getMemberId(string $groupId): string
    {
        $this->bot->setApi(Http::GROUP_MEMBER_ID_API);

        return $this->bot->http->get(array($groupId));
    }

    /**
     * Get member profile in group.
     *
     * @param  mixed $groupId
     * @param  mixed $userId
     *
     * @return string
     */
    public function getMemberProfile(string $groupId, string $userId): string
    {
        $this->bot->setApi(Http::GROUP_MEMBER_PROFILE_API);

        return $this->bot->http->get(array($groupId, $userId));
    }

    public function leaveGroup(string $groupId)
    {
        # code...
    }
}