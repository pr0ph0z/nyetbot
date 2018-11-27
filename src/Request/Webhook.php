<?php

namespace Nyetbot\Request;

/**
 * Webhook class based on Request
 * 
 * @package \Nyetbot\Request
 */
 class Webhook {

	private $webhookResponse;

	private $webhookEventObject;
	
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
		$this->webhookResponse = file_get_contents('php://input');
		$this->webhookEventObject = json_decode($this->webhookResponse);
    }

    /**
     * Get event given by webhook
     *
     * @since 0.2.0
     * 
     * @return string
     */
    public function getEventType(): string
    {
        return $this->webhookEventObject->{"events"}[0]->type;
    }

    /**
     * Determine is the event is message or not
     *
     * @since 0.2.0
     * 
     * @return void
     */
    public function isMessage(): bool
    {
        return ($this->webhookEventObject->{"events"}[0]->type === "message" ? true : false);
    }

    /**
     * Determine is the event is follow or not
     *
     * @since 0.2.0
     * 
     * @return void
     */
    public function isFollow(): bool
    {
        return ($this->webhookEventObject->{"events"}[0]->type === "follow" ? true : false);
    }

    /**
     * Determine is the event is unfollow or not
     *
     * @since 0.2.0
     * 
     * @return void
     */
    public function isUnfollow(): bool
    {
        return ($this->webhookEventObject->{"events"}[0]->type === "unfollow" ? true : false);
    }

    /**
     * Determine is the event is join or not
     *
     * @since 0.2.0
     * 
     * @return void
     */
    public function isJoin(): bool
    {
        return ($this->webhookEventObject->{"events"}[0]->type === "join" ? true : false);
    }

    /**
     * Determine is the event is leave or not
     *
     * @since 0.2.0
     * 
     * @return void
     */
    public function isLeave(): bool
    {
        return ($this->webhookEventObject->{"events"}[0]->type === "leave" ? true : false);
    }
 }

?>