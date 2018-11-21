<?php

namespace Nyetbot\Request;

/**
 * Message class based on Request
 * 
 * @package Request
 */
class Message
{

    public function __construct($parent)
    {
        $this->bot = $parent;
    }
    
	/**
	 * Method to push a text message
	 *
	 * @param  mixed $to	Line user ID of the target
	 * @param  mixed $text	The message
	 * 
	 * @since 0.0.1
	 *
	 * @return void
	 */
    public function pushText(string $to, string $text): void
    {
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
     
     /**
	 * Method to push a image message
	 *
	 * @param   string $to              Line user ID of the target
	 * @param   string $imageUrl        URL of the image (HTTPS)
     * @param   string $previewImageUrl Preview URL of the image to be displayed
     * @param mixed 
	 * 
	 * @since 0.0.1
	 *
	 * @return void
	 */
     public function pushImage(string $to, string $imageUrl, string $previewImageUrl = null): void
     {
		$this->bot->setApi("https://api.line.me/v2/bot/message/push");
		$body = array(
			'to' => $to,
			'messages' => [
				array(
					'type' => 'image',
					'originalContentUrl' => $imageUrl,
					'previewImageUrl' => $previewImageUrl ? $previewImageUrl : $imageUrl
				)
			]
        );
        $this->bot->http->post($body);
    }

    /**
	 * Method to push a video message
	 *
	 * @param   string $to              Line user ID of the target
	 * @param   string $videoURL        URL of the video (HTTPS)
     * @param   string $previewImageUrl Preview URL of the image to be displayed
     * @param mixed 
	 * 
	 * @since 0.0.1
	 *
	 * @return void
	 */
    public function pushVideo(string $to, string $videoUrl, string $previewImageUrl = null): void
    {
		$this->bot->setApi("https://api.line.me/v2/bot/message/push");
		$body = array(
			'to' => $to,
			'messages' => [
				array(
					'type' => 'video',
					'originalContentUrl' => $videoUrl,
					'previewImageUrl' => $previewImageUrl
				)
			]
		);

		$this->bot->http->post($body);
    }
    
    /**
	 * Method to push a audio message
	 *
	 * @param   string  $to         Line user ID of the target
	 * @param   string  $audioUrl   URL of the video (HTTPS)
     * @param   int     $duration   Duration of the audio (milliseconds)
     * @param mixed 
	 * 
	 * @since 0.0.1
	 *
	 * @return void
	 */
	public function pushAudio(string $to, string $audioUrl, int $duration){
		$this->bot->setApi("https://api.line.me/v2/bot/message/push");
		$body = array(
			'to' => $to,
			'messages' => [
				array(
					'type' => 'audio',
					'originalContentUrl' => $audioUrl,
					'duration' => $duration
				)
			]
		);

		$this->bot->http->post($body);
	}
}