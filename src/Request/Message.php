<?php

namespace Nyetbot\Request;

/**
 * Message class based on Request
 * 
 * @package Request
 */
class Message {

    public function __construct($parent)
    {
        $this->bot = $parent;
    }
    
	/**
	 * Method to send a message without reply token (let's say it push).
	 *
	 * @param  mixed $to	Line user ID of the target
	 * @param  mixed $text	The message
	 * 
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public function pushText(string $to, string $text){
		$this->bot->setApi("https://api.line.me/v2/bot/message/push");
		$body = array(
		    'to' => $to,
		    'messages' => [
				array(
					'type' => 'text',
					'text' => $text
				)
		    ]
		);

		$this->bot->http->post($body);
	 }
}