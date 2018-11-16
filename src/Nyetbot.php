<?php

namespace Nyetbot;

class Nyetbot
{
	protected $api;

	protected $channelAccessToken;

	protected $channelSecret;

	public function __construct($channelAccessToken = null, $channelSecret = null)
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

	public function setChannelAcessToken($channelAccessToken): void
	{
		$this->channelAccessToken = $channelAccessToken;
	}

	public function getChannelAccessToken(): string
	{
		return $this->channelAccessToken;
	}

	public function setChannelSecret($channelSecret): void
	{
		$this->channelSecret = $channelSecret;
	}

	public function getChannelSecret(): string
	{
		return $this->channelSecret;
	}

	public function setApi($api): void
	{
		$this->api = $api;
	}

	public function getApi(): string
	{
		return $this->api;
	}
}