<?php

namespace Nyetbot;

/**
 * This is Nyetbot's parent class.
 * 
 * @author Mohamad Radisha (pr0ph0z23@gmail.com)
 * @license MIT
 * @version 0.1.0
 * @since 0.0.0
 * @package \Nyetbot
 */
class Nyetbot
{
	/**
	 * @var string $api 	This property will store API URL that has been set.
	 */
	public $api;

	/**
	 * @var string $channelAccessToken 	This property will store access token that has been set.
	 */
	public $channelAccessToken;

	/**
	 * @var string $channelSecret 	This property will store channel secret that has been set.
	 */
	public $channelSecret;

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

		$this->http = new Request\Http($this);
		$this->message = new Request\Message($this);
		$this->profile = new Request\Profile($this);
		$this->webhook = new Request\Webhook($this);
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
}