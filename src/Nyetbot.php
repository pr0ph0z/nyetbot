<?php
/**
 * This is Nyetbot's parent class.
 * 
 * @author Mohamad Radisha (pr0ph0z23@gmail.com)
 * @license MIT
 * @version 0.0.1
 */

namespace Nyetbot;

class Nyetbot
{
	/**
	 * @var string $api 	This property will store API URL that has been set.
	 */
	protected $api;

	/**
	 * @var string $channelAccessToken 	This property will store access token that has been set.
	 */
	protected $channelAccessToken;

	/**
	 * @var string $channelSecret 	This property will store channel secret that has been set.
	 */
	protected $channelSecret;

	/**
	 * You can optionally using constructor.
	 * There are 2 way to set channel access token and channel secret.
	 * One of them is using this constructor.
	 *
	 * @param  string $channelAccessToken
	 * @param  string $channelSecret
	 *
	 * @return void
	 */
	public function __construct(string $channelAccessToken = null, string $channelSecret = null)
	{
		if($channelAccessToken != null)
		{
			$this->channelAccessToken = $channelAccessToken;
		}

		if($channelSecret != null)
		{
			$this->channelSecret = $channelSecret;
		}
	}

	/**
	 * Method to set channel access token.
	 *
	 * @param  string $channelAccessToken
	 *
	 * @return void
	 */
	public function setChannelAcessToken(string $channelAccessToken): void
	{
		$this->channelAccessToken = $channelAccessToken;
	}

	/**
	 * Method to get channel access token that has been set.
	 *
	 * @return string
	 */
	public function getChannelAccessToken(): string
	{
		return $this->channelAccessToken;
	}

	/**
	 * Method to set channel secret.
	 *
	 * @param  mixed $channelSecret
	 *
	 * @return void
	 */
	public function setChannelSecret($channelSecret): void
	{
		$this->channelSecret = $channelSecret;
	}

	/**
	 * Method to get channel secret that has been set.
	 *
	 * @return string
	 */
	public function getChannelSecret(): string
	{
		return $this->channelSecret;
	}

	/**
	 * Method to set API URL.
	 *
	 * @param  mixed $api
	 *
	 * @return void
	 */
	public function setApi($api): void
	{
		$this->api = $api;
	}

	/**
	 * Method to get API URL that has been set.
	 *
	 * @return string
	 */
	public function getApi(): string
	{
		return $this->api;
	}

	/**
	 * Method to make an HTTP Request using GET method.
	 * There are some API that needs an argument in its URL, so I added the $args parameter.
	 *
	 * @param  array $args
	 *
	 * @return mixed
	 */
	private function get(array $args = null)
	{
		if($args == null)
		{
			$ch = curl_init($this->api);
		}
		else
		{
			$ch = curl_init(vsprintf($this->api, $args));
		}
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$this->channelAccessToken
		));
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			error_log('Error:' . curl_error($ch));
		}
		curl_close($ch); 

		return $result;
	}

	/**
	 * Method to make an HTTP Request using POST method.
	 *
	 * @param  mixed $body Structural body to make a request
	 * @param  string $contentType Not all request is using json Content-Type. This is an optional parameter
	 * @param  array $args There are some API that needs an argument in its URL
	 *
	 * @return mixed
	 */
	private function post($body, string $contentType = "application/json", array $args = null)
	{
		if($args == null)
		{
			$ch = curl_init($this->api);
		}
		else
		{
			$ch = curl_init(vsprintf($this->api, $args));
		}
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		if($contentType !== "application/json") {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}
		else {
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		}
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
			'Content-Type: '.$contentType, 
			'Authorization: Bearer '.$this->channelAccessToken
		));
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			error_log('Error:' . curl_error($ch));
		}
		curl_close($ch); 

		return $result;
	}

	/**
	 * Method to make an HTTP Request using DELETE method.
	 *
	 * @return mixed
	 */
	public function delete()
	{
		$ch = curl_init($this->api);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$this->channelAccessToken
		));
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			error_log('Error:' . curl_error($ch));
		}
		curl_close($ch); 

		return $result;
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
		$this->setApi("https://api.line.me/v2/bot/message/push");
		$body = array(
		    'to' => $to,
		    'messages' => [
				array(
					'type' => 'text',
					'text' => $text
				)
		    ]
		);

		$this->post($body);
	 }
}