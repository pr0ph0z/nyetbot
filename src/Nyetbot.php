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

	private function get($args = null)
	{
		if($args == null) {
			$ch = curl_init($this->api);
		}
		else {
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

	private function post($body, $contentType = "application/json", $args = null){
		if($args == null) {
			$ch = curl_init($this->api);
		}
		else {
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
}