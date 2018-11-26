<?php

namespace Nyetbot\Request;

/**
 * Message class based on Request
 * 
 * @package \Nyetbot\Request
 */
class Message
{
	/**
	 * @var string PUSH_API URL of Push API
	 */
	private const PUSH_API = "https://api.line.me/v2/bot/message/push";

	/**
	 * @var string REPLY_API URL of Reply API
	 */
	private const REPLY_API = "https://api.line.me/v2/bot/message/reply";

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
    public function pushAudio(string $to, string $audioUrl, int $duration)
    {
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
    
    /**
	 * Method to push a location message
	 *
	 * @param   string  $to         Line user ID of the target
	 * @param   string  $title      Title of the location
     * @param   string  $address    Address of the location
     * @param   float   $latitude   Latitude of the location
     * @param   float   $longitude  Longitude of the location
     * @param mixed 
	 * 
	 * @since 0.0.1
	 *
	 * @return void
	 */
    public function pushLocation(string $to, string $title, string $address, float $latitude, float $longitude)
    {
		$this->bot->setApi("https://api.line.me/v2/bot/message/push");
		$body = array(
			'to' => $to,
			'messages' => [
				array(
					'type' => 'location',
					'title' => $title,
					'address' => $address,
					'latitude' => $latitude,
					'longitude' => $longitude
				)
			]
		);

		$this->bot->http->post($body);
    }
    
    /**
	 * Method to push a location message
	 *
	 * @param   string  $to         Line user ID of the target
	 * @param   string  $packageId  Package sticker ID
     * @param   string  $stickerId  Sticker ID
     * @param mixed 
	 * 
	 * @since 0.0.1
	 *
	 * @return void
	 */
    public function pushSticker($to, $packageId, $stickerId)
    {
        $this->bot->setApi("https://api.line.me/v2/bot/message/push");
        $body = array(
            'to'=> $to,
            'messages'=> [
                array(
                    'type'=> 'sticker',
                    'packageId'=> $packageId,
                    'stickerId'=> $stickerId
                )
            ]
        );

        $this->bot->http->post($body);
	}

	/**
	 * Get message input from user
	 *
	 * @since 0.1.0
	 * 
	 * @return void
	 */
	public function getMessageText(): string
	{
		$webhook = $this->webhookEventObject;
		$messageText = $webhook->{"events"}[0]->{"message"}->{"text"}; 
		
		return $messageText;
	}
    
	/**
	 * Method to reply a text message
	 *
	 * @param  mixed $text	The message
	 * 
	 * @since 0.1.0
	 *
	 * @return void
	 */
    public function replyText(string $text): void
    {
		$this->bot->setApi(self::REPLY_API);
		$webhook = $this->webhookEventObject;
		$replyToken = $webhook->{"events"}[0]->{"replyToken"};
		$body = array(
		    'replyToken' => $replyToken,
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
	 * Method to reply a image message
	 *
	 * @param   string $imageUrl        URL of the image (HTTPS)
     * @param   string $previewImageUrl Preview URL of the image to be displayed
     * @param mixed 
	 * 
	 * @since 0.1.1
	 *
	 * @return void
	 */
	public function replyImage(string $imageUrl, string $previewImageUrl = null): void
	{
		$this->bot->setApi(self::REPLY_API);
		$webhook = $this->webhookEventObject;
		$replyToken = $webhook->{"events"}[0]->{"replyToken"};
		$body = array(
			'replyToken' => $replyToken,
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
	* Method to reply a video message
	*
	* @param   string $videoURL        URL of the video (HTTPS)
	* @param   string $previewImageUrl Preview URL of the image to be displayed
	* @param mixed 
	* 
	* @since 0.1.1
	*
	* @return void
	*/
   public function replyVideo(string $videoUrl, string $previewImageUrl = null): void
   {
		$this->bot->setApi(self::REPLY_API);
		$webhook = $this->webhookEventObject;
		$replyToken = $webhook->{"events"}[0]->{"replyToken"};
		$body = array(
			'replyToken' => $replyToken,
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
	* Method to reply a audio message
	*
	* @param   string  $to         Line user ID of the target
	* @param   string  $audioUrl   URL of the video (HTTPS)
	* @param   int     $duration   Duration of the audio (milliseconds)
	* @param mixed 
	* 
	* @since 0.1.1
	*
	* @return void
	*/
   public function replyAudio(string $audioUrl, int $duration)
   {
		$this->bot->setApi(self::REPLY_API);
		$webhook = $this->webhookEventObject;
		$replyToken = $webhook->{"events"}[0]->{"replyToken"};
		$body = array(
			'replyToken' => $replyToken,
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