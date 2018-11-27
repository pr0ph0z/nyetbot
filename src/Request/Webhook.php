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

    public function getEventType()
    {
        return $this->webhookEventObject->{"events"};
    }
 }

?>